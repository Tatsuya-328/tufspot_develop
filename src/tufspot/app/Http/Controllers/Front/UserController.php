<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GaigokaiMember;
use Illuminate\Support\Facades\Auth;
use App\Models\SnsAccount;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // /**
    //  * 一覧画面
    //  *
    //  * @return \Illuminate\Contracts\View\View
    //  */
    // public function index()
    // {
    //     $users = User::latest('id')->paginate(20);
    //     return view('back.users.index', compact('users'));
    // }

    // /**
    //  * 登録画面
    //  *
    //  * @return \Illuminate\Contracts\View\View
    //  */
    // public function create()
    // {
    //     return view('back.users.create');
    // }

    // /**
    //  * 登録処理
    //  *
    //  * @param UserRequest $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function store(UserRequest $request)
    // {
    //     $user = User::create($request->all());

    //     if ($user) {
    //         return redirect()
    //             ->route('back.users.edit', $user)
    //             ->withSuccess('データを登録しました。');
    //     } else {
    //         return redirect()
    //             ->route('back.users.create')
    //             ->withError('データの登録に失敗しました。');
    //     }
    // }

    // /**
    //  * 編集画面
    //  *
    //  * @param User $user
    //  * @return \Illuminate\Contracts\View\View
    //  */
    // public function edit(User $user)
    // {
    //     return view('back.users.edit', compact('user'));
    // }

    /**
     * 詳細画面
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $user = User::with('snsAccounts')->where('id', '=', $user['id'])->first();
        return view('writer_detail', compact('user'));
    }

    /**
     * マイページ
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function mypage()
    {
        // dd(User::find(1)->gaigokaiMembers()->first());
        $user = Auth::user();
        // formファザード用
        $user['phone_number'] = $user->gaigokaiMembers[0]['phone_number'];
        // $user = User::with('snsAccounts')->where('id', '=', $user['id'])->first();
        return view('mypage', compact('user'));
        // return view('mypage');
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
        if (!empty($request['paddword']) && ($request['paddword'] !== $request['paddword_check'])) {
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

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\User $user
    //  * @return \Illuminate\Http\RedirectResponse
    //  * @throws \Exception
    //  */
    // public function destroy(User $user)
    // {
    //     if ($user->delete()) {
    //         $flash = ['success' => 'データを削除しました。'];
    //     } else {
    //         $flash = ['error' => 'データの削除に失敗しました'];
    //     }

    //     return redirect()
    //         ->route('back.users.index')
    //         ->with($flash);
    // }
}
