<?php
/**
 * @var \App\Models\Post $post
 */
?>
{{-- <form action="{{ 'PostsController@save' }}" method="post"> --}}
{{-- <form action="" method="post"> --}}
<div class="form-group row">
    {{ Form::label('title', 'タイトル', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{-- {{ Form::text('title', null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required',
            ]) }} --}}
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('body', '内容', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10" id="">
        {{-- {{ Form::textarea('body', null, [
                'class' => 'form-control' . ($errors->has('body') ? ' is-invalid' : ''),
                'rows' => 5,
            ]) }} --}}
        {{-- quill editor --}}
        <div id="quill_editor" class="">
        </div>
        {{-- quill変換後DB保存用隠し --}}
        {{-- <input type="hidden" name="main"> --}}
        <input name="body" style="display:none" id="body">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('tags', 'タグ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="{{ $errors->has('tags.*') ? 'is-invalid' : '' }}">
            @if ($tags)
                @foreach ($tags as $key => $tag)
                    <div class="form-check form-check-inline">
                        {!! Form::checkbox('tags[]', $key, null, ['class' => 'form-check-input', 'id' => 'tag' . $key]) !!}
                        <label class="form-check-label" for="tag{{ $key }}">{{ $tag }}</label>
                    </div>
                @endforeach
            @else
                タグ未登録
            @endif
        </div>
        @error('tags.*')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('is_public', '状態', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        @foreach (config('common.public_status') as $key => $value)
            <div class="form-check form-check-inline">
                {{ Form::radio('is_public', $key, null, [
                    'id' => 'is_public' . $key,
                    'class' => 'form-check-input' . ($errors->has('is_public') ? ' is-invalid' : ''),
                ]) }}
                {{ Form::label('is_public' . $key, $value, ['class' => 'form-check-label']) }}
                @if ($key === 0)
                    @error('is_public')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                @endif
            </div>
        @endforeach
    </div>
</div>

<div class="form-group row">
    {{ Form::label('published_at', '公開日', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::datetime('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i'), ['class' => 'form-control' . ($errors->has('published_at') ? ' is-invalid' : '')]) }}
        @error('published_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-10">
        <button type="button" class="btn btn-primary" name="subbtn">保存</button>
        {{ link_to_route('back.posts.index', '一覧へ戻る', null, ['class' => 'btn btn-secondary']) }}
    </div>
</div>
{{-- </form> --}}
<script>
    // 回答フォームを送信
    document.ansform.subbtn.addEventListener('click', function() {
        // ブログのやつ 
        // alert(document.querySelector('#quill_editor').innerHTML);
        // 公式demo
        var hoge = JSON.stringify(quill.getContents());

        // Quillのデータをinputに代入
        // document.querySelector('input[name=body]').value = document.querySelector('#quill_editor').innerHTML;
        document.querySelector('input[name=body]').value = hoge;
        // 送信
        document.ansform.submit();

        // var form = document.querySelector('form');
        // form.onsubmit = function() {
        // Populate hidden form on submit
        // var about = document.querySelector('input[name=about]');
        // about.value = JSON.stringify(quill.getContents());

        // console.log("Submitted", $(form).serialize(), $(form).serializeArray());

        // };
    });
</script>
