<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
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
        }

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $carousel_posts = Post::latest()->take(5)->get();    
        $pickup_posts = Post::inRandomOrder()->take(10)->get();
        $feature_posts = Post::inRandomOrder()->take(10)->get();
        
        $academia_category_id = Category::NAME['Academia'];
        $academia_posts = Post::whereHas('categories', function ($query) use ($academia_category_id) {
            $query->where('category_id', $academia_category_id);
        })->latest()->take(6)->get();

        $business_category_id = Category::NAME['Business'];
        $business_posts = Post::whereHas('categories', function ($query) use ($business_category_id) {
            $query->where('category_id', $business_category_id);
        })->latest()->take(6)->get();

        $culture_category_id = Category::NAME['Culture'];
        $culture_posts = Post::whereHas('categories', function ($query) use ($culture_category_id) {
            $query->where('category_id', $culture_category_id);
        })->latest()->take(6)->get();

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

    //     /**
    //  * プレビュー画面
    //  *
    //  * @param int $id
    //  * @return \Illuminate\Contracts\View\View
    //  */
    // public function preview(int $id, $request)
    // {
    //     $post = $request;
    //     // $post = Post::publicFindById($id);
    //     // return view('front.posts.show', compact('post'));
    //     return view('post_detail', compact('post'));
    // }

}
