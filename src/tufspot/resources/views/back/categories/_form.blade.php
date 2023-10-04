<?php
/**
 * @var \App\Models\Category $category
 */
?>
<div class="form-group row mb-2">
    {{ Form::label('name', 'カテゴリー名', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
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

<div class="form-group row mb-2">
    {{ Form::label('slug', 'URL末尾', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
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

<div class="form-group row mb-5">
    {{ Form::label('description', '説明文', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        {{ Form::textarea('description', null, [
            'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
            'placeholder' => 'カテゴリー一覧等に表示する文章',
            'required',
        ]) }}
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

@if (Route::is('back.categories.create'))
    <livewire:back.edit-table :all_posts="$all_posts" />
@else
    <livewire:back.edit-table :add_post_ids="$added_post_ids" :all_posts="$all_posts" />
@endif

<div class="form-group row">
    {{ Form::label('is_public', '状態', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        @foreach (config('common.public_status') as $key => $value)
            <div class="form-check form-check-inline">
                {{-- カテゴリー作成時のみ公開にデフォルトでチェックを入れておく --}}
                {{ Form::radio('is_public', $key, Route::is('back.categories.create') && $key === 1 ? true : null, [
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

<div class="d-flex justify-content-between mt-4 mb-4">
    <div class="">
        {{ link_to_route('back.categories.index', '一覧へ', null, ['class' => 'btn btn-outline-dark']) }}
    </div>
    <div class="">
        <button type="submit" class="btn btn-success" name="subbtn">保存</button>
    </div>
</div>
