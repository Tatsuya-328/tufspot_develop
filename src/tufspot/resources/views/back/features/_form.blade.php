<?php
/**
 * @var \App\Models\Category $feature
 */
?>
<div class="form-group row">
    {{ Form::label('name', '特集名', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, [
            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('slug', 'スラッグ(URL名)', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::text('slug', null, [
            'class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('description', '説明文(特集記事一覧等に表示)', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('description', null, [
            'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- TODO 全記事 ＋ 対象記事にはチェック --}}
@if (Route::is('back.features.create'))
    <livewire:back.interactive-table :all_posts="$all_posts" />
@else
    <livewire:back.interactive-table :add_post_ids="$added_post_ids" :all_posts="$all_posts" />
@endif

<div class="form-group row">
    {{ Form::label('is_public', '状態', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        @foreach (config('common.public_status') as $key => $value)
            <div class="form-check form-check-inline">
                {{-- 特集作成時のみ公開にデフォルトでチェックを入れておく --}}
                {{ Form::radio('is_public', $key, Route::is('back.features.create') && $key === 1 ? true : null, [
                    'id' => 'is_public' . $key,
                    'class' => 'form-check-input' . ($errors->has('is_public') ? ' is-invalid' : ''),
                ]) }}
                {{ Form::label('is_public' . $key, $value, ['class' => 'form-check-label']) }}
                @if ($key === 1)
                    @error('is_public')
                        <div class="text-danger form-check form-check-inline">
                            {{ $message }}
                        </div>
                    @enderror
                @endif
            </div>
        @endforeach
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">保存</button>
        {{ link_to_route('back.features.index', '一覧へ戻る', null, ['class' => 'btn btn-secondary']) }}
    </div>
</div>
