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
        <input type="text" class="form-control" name="title" value="{{ old('title', $post['title']) }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('body', '内容', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10 h-100" id="">
        {{-- quill editor --}}
        <div id="quill_editor" class="">
            <?= $post['body'] ?>
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
        // ブログの試し html用のタグ付きのデータ保存はできた
        // TODO 編集時のこと考えると、公式で保存して、見た目もcss適用してブログと同じようにした方が楽？
        document.querySelector('input[name=body]').value = document.querySelector('.ql-editor').innerHTML;

        // 公式demo qulill用のデータになった。編集画面で再度エディター表示するならこれを使う？
        // var hoge = JSON.stringify(quill.getContents());
        // document.querySelector('input[name=body]').value = hoge;

        // 送信
        document.ansform.submit();
        // console.log("Submitted", $(form).serialize(), $(form).serializeArray());

        // };
    });
</script>