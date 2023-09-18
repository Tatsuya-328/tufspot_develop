<?php

namespace App\Http\Controllers\Back;

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
        $posts = Post::with('user', 'tags', 'categories')->search($request)->latest('id')->paginate(20);

        $search = $request->all();
        $users = User::pluck('name', 'id')->toArray();

        return view('back.posts.index', compact('posts', 'search', 'users'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back.posts.create');
    }

    /**
     * 登録処理
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        // 画像保存
        // ディレクトリ名
        $dir = 'image/article';
        $featured_image_path = $request->file('featured_image')->store('public/' . $dir);
        // ファイル情報をDBに保存
        $featured_image_path = str_replace("public","storage",$featured_image_path);

        $post = Post::create([
            'title' => $request['title'],
            'featured_image_path' => $featured_image_path,
            'body' => $request['body'],
            'is_public' => $request['is_public'],
            'published_at' => $request['published_at'],
        ]);
        // $post = Post::create($request->all());
        // タグを追加
        $post->tags()->attach($request->tags);
        // カテゴリーを追加
        $post->categories()->attach($request->categories);
        if ($post) {
            return redirect()
                ->route('back.posts.edit', $post)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.posts.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * 編集画面
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        return view('back.posts.edit', compact('post'));
    }

    /**
     * 更新処理
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        // タグを更新
        $post->tags()->sync($request->tags);
        // カテゴリーを更新
        $post->categories()->sync($request->categories);

        // 画像保存
        // ディレクトリ名
        if ($request->file('featured_image')) {
            $dir = 'image/article';
            $featured_image_path = $request->file('featured_image')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $featured_image_path = str_replace("public","storage",$featured_image_path);
        } else {
            $featured_image_path = $post['featured_image_path'];
        }
    
        if (
            $post->update([
                'title' => $request['title'],
                'featured_image_path' => $featured_image_path,
                'body' => $request['body'],
                'is_public' => $request['is_public'],
                'published_at' => $request['published_at'],
            ])
        ) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.posts.edit', $post)
            ->with($flash);
    }

    /**
     * 削除処理
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        // タグを削除
        $post->tags()->detach();
        // タグを削除
        $post->categories()->detach();

        if ($post->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.posts.index')
            ->with($flash);
    }
}
