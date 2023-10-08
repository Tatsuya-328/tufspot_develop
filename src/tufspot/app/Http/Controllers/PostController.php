<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Feature;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $tagSlug = null;
    private $categorySlug = null;
    private $featureSlug = null;

    // 閲覧履歴の最大保持数
    const MAX_HISTORY_COUNT = 12;

    // タグの読み込み処理を共通にする
    public function __construct()
    {
        $this->middleware(function ($request, \Closure $next) {
            \View::share('tags', Tag::pluck('name', 'id')->toArray());
            return $next($request);
        })->only('index', 'create', 'edit');

        // カテゴリー用
        $this->middleware(function ($request, \Closure $next) {
            \View::share('categories', Category::pluck('name', 'id')->toArray());
            return $next($request);
        })->only('index', 'create', 'edit');

        // 特集用
        $this->middleware(function ($request, \Closure $next) {
            \View::share('categories', Feature::pluck('name', 'id')->toArray());
            return $next($request);
        })->only('index', 'create', 'edit');
    }

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // タグ検索していないためthis->slugでよい
        // 最新
        $carousel_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug,)->take(5)->get();
        // TODO: 注目記事という特集項目から取得
        $pickup_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->inRandomOrder()->take(10)->get();
        // 特集項目を選択する？特集全体からランダム？一旦全体からランダム
        $feature_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->inRandomOrder()->take(10)->get();

        // TODO: Category::NAMEよりもCategory::IDの方が直感的な気がする、影響範囲が不明のためいったん放置
        // 公開・非公開の出し分けはview側でもできるが、Controller内の方が無駄なクエリを発行せずに済みそう
        $academia_category_id = Category::NAME['Academia'];
        $academia_category = Category::find($academia_category_id);
        $is_academia_public = $academia_category->is_public;
        $academia_posts = null;
        if ($is_academia_public) {
            $academia_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->whereHas('categories', function ($query) use ($academia_category_id) {
                $query->where('category_id', $academia_category_id);
            })->take(12)->get();
        }

        $business_category_id = Category::NAME['Business'];
        $business_category = Category::find($business_category_id);
        $is_business_public = $business_category->is_public;
        $business_posts = null;
        if ($is_business_public) {
            $business_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->whereHas('categories', function ($query) use ($business_category_id) {
                $query->where('category_id', $business_category_id);
            })->take(12)->get();
        }

        $culture_category_id = Category::NAME['Culture'];
        $culture_category = Category::find($culture_category_id);
        $is_culture_public = $culture_category->is_public;
        $culture_posts = null;
        if ($is_culture_public) {
            $culture_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->whereHas('categories', function ($query) use ($culture_category_id) {
                $query->where('category_id', $culture_category_id);
            })->take(12)->get();
        }

        $search = $request->all();
        $users = User::pluck('name', 'id')->toArray();
        return view('index', compact('carousel_posts', 'pickup_posts', 'feature_posts', 'academia_posts', 'academia_category', 'business_posts', 'business_category', 'culture_posts', 'culture_category'));
    }

    /**
     * 詳細画面
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $user = Auth::user();
        $post = Post::publicFindById($id);

        if ($user->histories->contains($post->id)) { // 閲覧履歴の更新
            $user->histories()->updateExistingPivot($post->id, [
                'updated_at' => Carbon::now(),
            ]);
        } else if ($user->histories()->count() >= self::MAX_HISTORY_COUNT) { // 最も古い閲覧履歴の削除後、新規追加
            $oldest_history_post = $user->histories()->orderByPivot('updated_at', 'asc')->first();
            $user->histories()->detach($oldest_history_post->id);
            $user->histories()->attach($post->id);
        } else { // 閲覧履歴の新規追加
            $user->histories()->attach($post->id);
        }

        return view('post_detail', compact('post'));
    }

    /**
     * カテゴリー・特集項目一覧
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function category()
    {
        $categories = Category::oldest('id')->get();
        $features = Feature::latest('id')->get();
        return view('category', compact('categories', 'features'));
    }

    /**
     * カテゴリー・特集の対象記事一覧
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function category_detail($type, $slug)
    {
        // カテゴリー取得のためのswitch文
        // 投稿はLivewire側で取得する（ページネーションのため）
        switch ($type) {
            case 'category':
                $this->categorySlug = $slug;
                $category = Category::where('slug', $slug)->first();
                break;
            case 'feature':
                $this->featureSlug = $slug;
                $category = Feature::where('slug', $slug)->first();
                break;
        }
        return view('category_detail', compact('category', 'type', 'slug'));
    }

    /**
     * 記事検索
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        // 全角スペースを半角スペースに変換
        $keywords = mb_convert_kana($request->keywords, 's', 'UTF-8');
        $keywordArr = explode(" ", $keywords);

        $search_filter = $request->search_filter;

        return view('search_result', compact('keywordArr', 'search_filter'));
    }

    /**
     * ハッシュタグによる記事一覧表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function hashtag(string $tag_slug)
    {
        $tag_name = Tag::where('slug', $tag_slug)->first()->name;
        return view('hashtag_result', compact('tag_slug', 'tag_name'));
    }

    // public function index(string $tagSlug = null)
    // {
    //     // 公開・新しい順に表示
    //     $posts = Post::publicList($tagSlug);
    //     $tags = Tag::all();

    //     return view('front.posts.index', compact('posts', 'tags'));
    // }
}
