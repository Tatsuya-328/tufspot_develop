<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Http\Requests\FeatureRequest;

class FeatureController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $features = Feature::latest('id')->paginate(20);
        return view('back.features.index', compact('features'));
    }

    /**
     * 登録画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('back.features.create');
    }

    /**
     * 登録処理
     *
     * @param FeatureRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FeatureRequest $request)
    {
        $feature = Feature::create($request->all());

        if ($feature) {
            return redirect()
                ->route('back.features.edit', $feature)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.features.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * 編集画面
     *
     * @param Feature $feature
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Feature $feature)
    {
        return view('back.features.edit', compact('feature'));
    }

    /**
     * 更新処理
     *
     * @param  FeatureRequest $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FeatureRequest $request, Feature $feature)
    {
        if ($feature->update($request->all())) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.features.edit', $feature)
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Feature $feature)
    {
        if ($feature->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.features.index')
            ->with($flash);
    }
}
