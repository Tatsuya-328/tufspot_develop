<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SnsAccount;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        // 執筆者は自分以外のユーザーにはアクセスできない
        if (Auth::user()->role === 2) {
            if (Auth::id() !== $user->id) {
                abort(404);
            }
        }
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
        extract($request->toArray());
        $isSucceeded[] = $user->update(compact('name', 'role', 'email', 'introduction'));

        // パスワード更新
        if (isset($request['password'])) {
            $password = Hash::make($request['password']);
            $isSucceeded[] = $user->update(compact('password'));
        }

        // 画像保存: 表示されない場合は php artisan storage:link を実行すること
        if ($request->file('featured_image') !== null) {
            $dir = 'image/user'; // ディレクトリ名
            $putPath = Storage::putFile("public/$dir", $request->file('featured_image'));
            $profile_image_path = Storage::url($putPath);
            $isSucceeded[] = $user->update(compact('profile_image_path'));
        }

        // SNS保存
        SnsAccount::where('user_id', $request['user_id'])->delete();
        if (isset($request['alreadySnsAccounts'])) {
            foreach ($request['alreadySnsAccounts'] as $alreadySnsAccount) {
                if (isset($alreadySnsAccount['name'], $alreadySnsAccount['url'])) {
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
        if (isset($request['newSnsAccounts'])) {
            foreach ($request['newSnsAccounts'] as $newSnsAccount) {
                if (isset($newSnsAccount['name'], $newSnsAccount['url'])) {
                    SnsAccount::create([
                        'user_id' => $request['user_id'],
                        'name' => $newSnsAccount['name'],
                        'url' => $newSnsAccount['url'],
                    ]);
                }
            }
        }

        // 添字配列 $isSucceeded に false (Model::update 失敗時の返り値) が含まれるかどうか
        $flash = match (in_array(false, $isSucceeded)) {
            false => ['success' => 'データを更新しました。'],
            true => ['error' => 'データの更新に失敗しました'],
        };

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
