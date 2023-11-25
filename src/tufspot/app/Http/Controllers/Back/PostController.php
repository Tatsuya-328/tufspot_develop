<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use App\Models\Feature;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\ReservationPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // 特集項目用
        $this->middleware(function ($request, \Closure $next) {
            \View::share('features', Feature::pluck('name', 'id')->toArray());
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
        $user_id = Auth::id();
        // 画像保存
        $featured_image_path = null;
        if (isset($request->featured_image)) {
            // ディレクトリ名
            $dir = 'image/post';
            $featured_image_path = $request->file('featured_image')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $featured_image_path = str_replace("public", "storage", $featured_image_path);
            // TODO プレビュー時のtmp画像削除する
        }

        if ($request->is_public === "2") {
            $post = Post::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'featured_image_path' => $featured_image_path,
                'body' => $request['body'],
                'is_public' => $request['is_public'],
                'date' => str_replace('-', '', $request['date']),
                'time' => $request->hour . $request->min . '00',
                'published_at' => $request->date . " " . $request->hour . ":" . $request->min . ":00",
                'user_id' => $user_id,
                'update_user_id' => $user_id,
            ]);

            ReservationPost::create([
                'post_id' => $post->id,
                'user_id' => $user_id,
                'date' => str_replace('-', '', $request['date']),
                'time' => $request->hour . $request->min . '00',
            ]);
        } else {
            $post = Post::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'featured_image_path' => $featured_image_path,
                'body' => $request['body'],
                'is_public' => $request['is_public'],
                'published_at' => $request['published_at'],
                'user_id' => $user_id,
                'update_user_id' => $user_id,
            ]);
        }

        // タグを追加
        $post->tags()->attach($request->tags);
        // カテゴリーを追加
        $post->categories()->attach($request->categories);
        // 特集項目を追加
        $post->features()->attach($request->features);
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
     * プレビュー画面
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function preview(string $id = null, PostUpdateRequest $request)
    {
        $post = $request;

        if ($id && Post::findById($id)) {
            $savedPost = Post::findById($id);
        }

        if (empty($post['featured_image'])) {
            $post['featured_image_path'] = $savedPost['featured_image_path'];
        } else {
            // 画像保存
            // ディレクトリ名
            $dir = 'image/post/tmp';
            $featured_image_path = $request->file('featured_image')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $featured_image_path = str_replace("public", "storage", $featured_image_path);
            $post['featured_image_path'] = $featured_image_path;
        }

        // $post = Post::publicFindById($id);
        // return view('front.posts.show', compact('post'));
        return view('post_detail', compact('post'));
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
        $update_user_id = Auth::id();
        $is_success = false;
        // タグを更新
        $post->tags()->sync($request->tags);
        // カテゴリーを更新
        $post->categories()->sync($request->categories);
        // 特集項目を更新
        $post->features()->sync($request->features);

        // 画像保存
        // ディレクトリ名
        if ($request->file('featured_image')) {
            $dir = 'image/post';
            $featured_image_path = $request->file('featured_image')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $featured_image_path = str_replace("public", "storage", $featured_image_path);
        } else {
            $featured_image_path = $post['featured_image_path'];
        }

        if ($request->is_public === "2") {
            $post->update([
                'title' => $request['title'],
                'description' => $request['description'],
                'featured_image_path' => $featured_image_path,
                'body' => $request['body'],
                'is_public' => $request['is_public'],
                'date' => str_replace('-', '', $request['date']),
                'time' => $request->hour . $request->min . '00',
                'published_at' => $request->date . " " . $request->hour . ":" . $request->min . ":00",
                'update_user_id' => $update_user_id,
            ]);

            if (is_null($post->reservationPost)) {
                ReservationPost::create([
                    'post_id' => $post->id,
                    'user_id' => $update_user_id,
                    'date' => str_replace('-', '', $request['date']),
                    'time' => $request->hour . $request->min . '00',
                ]);
            } else {
                $post->reservationPost->update([
                    'post_id' => $post->id,
                    'user_id' => $update_user_id,
                    'date' => str_replace('-', '', $request['date']),
                    'time' => $request->hour . $request->min . '00',
                ]);
            }
            $is_success = true;
        } else {
            $post->update([
                'title' => $request['title'],
                'description' => $request['description'],
                'featured_image_path' => $featured_image_path,
                'body' => $request['body'],
                'is_public' => $request['is_public'],
                'published_at' => Carbon::now()->format('Y-m-d H:i'),
                'update_user_id' => $update_user_id,
            ]);

            if (isset($post->reservationPost)) {
                $post->reservationPost->delete();
            }
            $is_success = true;
        }

        if ($is_success) {
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

        $post->features()->detach();

        if (isset($post->reservationPost)) {
            $post->reservationPost->delete();
        }


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
