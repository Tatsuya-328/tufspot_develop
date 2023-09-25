<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\GaigokaiMember;
use Illuminate\Support\Facades\Auth;
use App\Models\SnsAccount;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $tagSlug = null;
    private $categorySlug = null;
    private $featureSlug = null;

    /**
     * 詳細画面
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        // 管理者かつ記事を持っている(公開済み)ユーザーのみ表示（ユーザー一覧でもやる）
        $user = User::with('posts')->where([
            ['id', '=', $user['id']],
            ['role', '=', 1],
        ])->whereHas('posts', function ($q) {
            $q->whereExists(function ($q) {
                return $q;
            });
        })->first();
        if (empty($user)) {
            abort(404, '存在しないページです');
        }

        return view('writer_detail', compact('user'));
    }

    /**
     * 詳細画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        // 管理者かつ記事を持っている(公開)ユーザーのみ表示
        $public = 1;
        // TODO: ページネーションで一度に表示人数絞る
        $writers = User::where([
            ['role', '=', 1],
        ])->with(['posts' => function ($query) use ($public) {
            $query->where('is_public', $public);
        }])->whereHas('posts', function ($query) {
            $query->whereExists(function ($query) {
                return $query;
            });
        })->get();
        return view('writer_list', compact('writers'));
    }

    /**
     * マイページ
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function mypage()
    {
        $user = Auth::user();
        // formファザード用
        $user['phone_number'] = $user->gaigokaiMembers[0]['phone_number'];

        // TODO: お気に入りはひとまず6件だけ取得、必要ならあとからPagination追加
        // $liked_posts = $user->likes()->take(6)->get();
        // TODO: 閲覧履歴 仮で適当に取得
        $history_posts = Post::publicList($this->tagSlug, $this->categorySlug, $this->featureSlug)->take(6)->get();
        // TODO: とりあえずフォロー済ライターを全件取得
        $following_writers = $user->followings()->get();

        return view('mypage', compact('user', 'history_posts', 'following_writers'));
    }

    /**
     * 更新処理
     *
     * @param  UserRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $gaigokai = GaigokaiMember::find($request['id']);
        if (!empty($request['password']) && ($request['password'] !== $request['password_check'])) {
            $flash = ['error' => 'パスワード確認が同一ではありません。'];
        }

        if ($user->update($request->all()) && $gaigokai->update(['phone_number' => $request['phone_number']])) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        // formファザード用
        $user['phone_number'] = $user->gaigokaiMembers[0]['phone_number'];
        return redirect()
            ->route('mypage', $user)
            ->with($flash);
    }
}
