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
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $tagSlug = null;
    private $categorySlug = null;
    private $featureSlug = null;

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

        $academia_category_id = Category::NAME['Academia'];
        $academia_category = Category::find($academia_category_id);
        $academia_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->whereHas('categories', function ($query) use ($academia_category_id) {
            $query->where('category_id', $academia_category_id);
        })->take(12)->get();

        $business_category_id = Category::NAME['Business'];
        $business_category = Category::find($business_category_id);
        $business_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->whereHas('categories', function ($query) use ($business_category_id) {
            $query->where('category_id', $business_category_id);
        })->take(12)->get();

        $culture_category_id = Category::NAME['Culture'];
        $culture_category = Category::find($culture_category_id);
        $culture_posts = Post::PublicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->whereHas('categories', function ($query) use ($culture_category_id) {
            $query->where('category_id', $culture_category_id);
        })->take(12)->get();

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
        $post = Post::publicFindById($id);
        // return view('front.posts.show', compact('post'));
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

    // public function index(string $tagSlug = null)
    // {
    //     // 公開・新しい順に表示
    //     $posts = Post::publicList($tagSlug);
    //     $tags = Tag::all();

    //     return view('front.posts.index', compact('posts', 'tags'));
    // }
}
