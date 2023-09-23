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
        // タグ検索していないためnull
        $tagSlug = null;
        $carousel_posts = Post::PublicList($tagSlug)->take(5)->get();
        $pickup_posts = Post::PublicList($tagSlug)->inRandomOrder()->take(10)->get();
        $feature_posts = Post::PublicList($tagSlug)->inRandomOrder()->take(10)->get();

        $academia_category_id = Category::NAME['Academia'];
        $academia_posts = Post::PublicList($tagSlug)->whereHas('categories', function ($query) use ($academia_category_id) {
            $query->where('category_id', $academia_category_id);
        })->take(6)->get();

        $business_category_id = Category::NAME['Business'];
        $business_posts = Post::PublicList($tagSlug)->whereHas('categories', function ($query) use ($business_category_id) {
            $query->where('category_id', $business_category_id);
        })->take(6)->get();

        $culture_category_id = Category::NAME['Culture'];
        $culture_posts = Post::PublicList($tagSlug)->whereHas('categories', function ($query) use ($culture_category_id) {
            $query->where('category_id', $culture_category_id);
        })->take(6)->get();

        $search = $request->all();
        $users = User::pluck('name', 'id')->toArray();

        return view('index', compact('carousel_posts', 'pickup_posts', 'feature_posts', 'academia_posts', 'business_posts', 'culture_posts'));
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
    public function category_detail(string $slug = null)
    {
        $tagSlug = null;
        $tagSlug = null;
        $tagSlug = null;
        $posts = Post::publicList($tagSlug, $tagSlug, $tagSlug,)->get();
        $category = Category::where('slug', $slug)->first();
        // $categories = Category::oldest('id')->get();
        // $features = Feature::latest('id')->get();
        dd($posts, $category);
        return view('category', compact('categories', 'features'));
    }

    // public function index(string $tagSlug = null)
    // {
    //     // 公開・新しい順に表示
    //     $posts = Post::publicList($tagSlug);
    //     $tags = Tag::all();

    //     return view('front.posts.index', compact('posts', 'tags'));
    // }
}
