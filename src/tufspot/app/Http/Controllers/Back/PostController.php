<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\PostRequest;
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
    }

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $posts = Post::with('user', 'tags')->search($request)->latest('id')->paginate(20);

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

            // アップロードされたファイル名を取得
            // $file_name = $request->file('featured_image')->getClientOriginalName();
    
            // 取得したファイル名で保存
            $featured_image_path = $request->file('featured_image')->store('public/' . $dir);
            
            // ファイル情報をDBに保存
            // $image = new Image();
            $featured_image_path = str_replace("public","storage",$featured_image_path);
            // $featured_image_path = 'storage/' . $dir . '/' . $file_name;
            // $request['file']['featured_image_path']['pathname'] = $featured_image_path;
            // // $image->save();

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
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
dd($request);

        // タグを更新
        $post->tags()->sync($request->tags);

        // ディレクトリ名
        $dir = 'image/article';

        // アップロードされたファイル名を取得
        $file_name = $request->file('featured_image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('featured_image')->storeAs('public/' . $dir, $file_name);
        
        // ファイル情報をDBに保存
        // $image = new Image();
        $featured_image_path = 'storage/' . $dir . '/' . $file_name;
        $request['featured_image'] = $featured_image_path;
        // $image->save();

        if ($post->update($request->all())) {
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
