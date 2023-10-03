<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\CategoryRequest;
use GuzzleHttp\Psr7\Request;

class CategoryController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(20);
        return view('back.categories.index', compact('categories'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $posts = Post::get();
        return view('back.categories.create', compact('posts'));
    }

    /**
     * 登録処理
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        // TODO: 記事登録と中間更新をトランザクションにする
        $category = Category::create($request->all());

        // category_postの更新
        if ($request->add_post_ids) {
            $category->posts()->sync($request->add_post_ids);
        }

        if ($category) {
            return redirect()
                ->route('back.categories.edit', $category)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.categories.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * 編集画面
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        $request['category_id'] = $category['id'];
        $added_post_ids = Post::searchByArray($request)->pluck('id')->toArray();
        // $posts = Post::get();
        // foreach ($posts as &$post) {
        //     foreach ($post['categories'] as $post_category) {
        //         if ($post_category['id'] === $category['id']) {
        //             $post['has_category'] = 1;
        //         }
        //     }
        // }
        // unset($post);
        // dd($added_posts);
        return view('back.categories.edit', compact('category', 'added_post_ids'));
        // return view('back.categories.edit', compact('category', 'posts', 'added_posts'));
    }

    /**
     * 更新処理
     *
     * @param  CategoryRequest $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // category_postの更新
        if ($request->add_post_ids) {
            $category->posts()->sync($request->add_post_ids);
        }

        // category自体の更新
        if ($category->update($request->all())) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.categories.edit', $category)
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->posts()->sync(null);
        if ($category->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.categories.index')
            ->with($flash);
    }
}
