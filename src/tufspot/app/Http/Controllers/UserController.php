<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\GaigokaiMember;
use Illuminate\Support\Facades\Auth;
use App\Models\SnsAccount;
use App\Http\Requests\UserRequest;
use Exception;

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
    public function show(string $user)
    {
        try {
            // 管理者ユーザーの場合は取得（ユーザー一覧でもやる）
            $user = User::with('posts')->where([
                ['name', '=', "$user"],
                ['role', '=', 1],
            ])->firstOrFail();

            // 公開済み記事数が 0 の場合も 404 を返す
            if ($user->posts->count() === 0) {
                throw new Exception();
            }

            return view('writer_detail', compact('user'));
        } catch (Exception) {
            abort(404, '存在しないページです');
        }
    }

    /**
     * 詳細画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('writer_list');
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

        return view('mypage', compact('user'));
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
