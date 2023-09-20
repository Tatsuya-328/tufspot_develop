<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SnsAccount;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::latest('id')->paginate(20);
        return view('back.users.index', compact('users'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back.users.create');
    }

    /**
     * 登録処理
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        if ($user) {
            return redirect()
                ->route('back.users.edit', $user)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.users.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * 編集画面
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $user = User::with('snsAccounts')->where('id', '=', $user['id'])->first();
        // $sns = SnsAccount::where($user['id'])->get();
        return view('back.users.edit', compact('user'));
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
        // dd($request);
        // 画像保存
        // ディレクトリ名
        if ($request->file('profile_image')) {
            $dir = 'image/user';
            $profile_image_path = $request->file('profile_image')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $profile_image_path = str_replace("public","storage",$profile_image_path);
        } else {
            $profile_image_path = $user['profile_image_path'];
        }

        // SNS保存
        SnsAccount::where('user_id', $request['user_id'])->delete();
        if ($request['alreadySnsAccounts']) {
            foreach ($request['alreadySnsAccounts'] as $alreadySnsAccount) {
                if (!empty($alreadySnsAccount['name']) && !empty($alreadySnsAccount['url'])) {
                // Employee::where('id', $alreadySnsAccount['id'])
                //     ->update([
                SnsAccount::create([
                        'user_id' => $request['user_id'],
                        'name' => $alreadySnsAccount['name'],
                        'url' => $alreadySnsAccount['url'],
                    ]);
                }
            }
        }
        if ($request['newSnsAccounts']) {
        foreach ($request['newSnsAccounts'] as $newSnsAccount) {
            if (!empty($newSnsAccount['name']) && !empty($newSnsAccount['url'])) {
            SnsAccount::create([
                    'user_id' => $request['user_id'],
                    'name' => $newSnsAccount['name'],
                    'url' => $newSnsAccount['url'],
                ]);
                }
            }
    }
        // if ($user->update($request->all())) {
            if (
                $user->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'profile_image_path' => $profile_image_path,
                    'password' => Hash::make($request['password']),
                    'role' => $request['role'],
                    'introduction' => $request['introduction'],
                ])
                ) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }
        return redirect()
            ->route('back.users.edit', $user)
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.users.index')
            ->with($flash);
    }
}
