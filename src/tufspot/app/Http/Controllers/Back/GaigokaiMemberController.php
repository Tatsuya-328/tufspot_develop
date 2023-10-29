<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaigokaiMember\UpdateRequest;
use App\Http\Requests\GaigokaiMember\CreateRequest;
use App\Models\GaigokaiMember;

class GaigokaiMemberController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $gaigokaiMembers = GaigokaiMember::with('users')->orderByDesc('id')->paginate(20);
        return view('back.gaigokaiMembers.index', compact('gaigokaiMembers'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back.gaigokaiMembers.create');
    }

    /**
     * 登録処理
     *
     * @param App\Http\Requests\GaigokaiMember\CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $gaigokaiMember = GaigokaiMember::create($request->all());

        if ($gaigokaiMember) {
            return redirect()
                ->route('back.gaigokaiMembers.edit', $gaigokaiMember)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.gaigokaiMembers.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * 編集画面
     *
     * @param GaigokaiMember $gaigokaiMember
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(GaigokaiMember $gaigokaiMember)
    {
        return view('back.gaigokaiMembers.edit', compact('gaigokaiMember'));
    }

    /**
     * 更新処理
     *
     * @param  App\Http\Requests\GaigokaiMember\UpdateRequest $request
     * @param  \App\Models\GaigokaiMember $gaigokaiMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, GaigokaiMember $gaigokaiMember)
    {
        $isSucceeded = $gaigokaiMember->update(['phone_number' => $request->phone_number]);

        $flash = match ($isSucceeded) {
            true => ['success' => 'データを更新しました。'],
            false => ['error' => 'データの更新に失敗しました'],
        };

        return redirect()
            ->route('back.gaigokaiMembers.edit', compact('gaigokaiMember'))
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GaigokaiMember $gaigokaiMember
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(GaigokaiMember $gaigokaiMember)
    {
        $isSucceeded = $gaigokaiMember->delete();

        $flash =  match ($isSucceeded) {
            true => ['success' => 'データを削除しました。'],
            false => ['error' => 'データの削除に失敗しました。'],
        };

        return redirect()
            ->route('back.gaigokaiMembers.index')
            ->with($flash);
    }
}
