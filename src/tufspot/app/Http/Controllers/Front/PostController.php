<?php

namespace App\Http\Controllers\Front;

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
        // ページネーションが有効になっているから20のみ取得状態
        $posts = Post::with('user', 'tags', 'categories')->search($request)->latest('id')->paginate(20);

        $search = $request->all();
        $users = User::pluck('name', 'id')->toArray();
        // dd($posts);
        return view('index', compact('posts', 'search', 'users'));
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
        return view('article_detail', compact('post'));
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
    //     return view('article_detail', compact('post'));
    // }

}
