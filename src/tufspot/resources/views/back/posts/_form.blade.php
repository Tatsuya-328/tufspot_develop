<?php
/**
 * @var \App\Models\Post $post
 */
?>
<div class="form-group row mb-2">
    {{ Form::label('title', 'タイトル', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        @if (Request::is('admin/posts/create'))
            <textarea id="title_textarea" type="textarea" class="form-control" name="title">{{ old('title') }}</textarea>
        @else
            <textarea id="title_textarea" type="text" class="form-control" name="title">{{ old('title', $post['title']) }}</textarea>
        @endif
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row mb-2">
    {{ Form::label('description', '説明文', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        @if (Request::is('admin/posts/create'))
            <textarea id="description_textarea" type="textarea" class="form-control" name="description">{{ old('description') }} </textarea>
        @else
            <textarea id="description_textarea" type="text" class="form-control" name="description">{{ old('description', $post['description']) }}</textarea>
        @endif
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row mb-5">
    {{ Form::label('body', '本文', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col h-100" id="">
        <div id="quill_editor" class="">
            @if (Request::is('admin/posts/create'))
                {!! old('body') !!}
            @else
                {!! $post['body'] !!}
            @endif
        </div>
        {{-- quill変換後DB保存用隠し --}}
        <input name="body" style="display:none" id="body">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row mb-2">
    {{ Form::label('featured_image', 'アイキャッチ', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        @if (!Request::is('admin/posts/create'))
            @if ($post['featured_image_path'])
                既存<br>
                <img class="featured_image" src="{{ asset($post->featured_image_path) }}" alt="">
            @endif
        @endif
        <input type="file" class="form-control" name="featured_image" value="{{ old('featured_image') }}" onchange="previewImage(this);">
        <input type="button" id="clear" value="画像選択解除" onclick="unsetImage();" style="display: none">
        <div class="image_preview" id="image_preview" style="display: none">
            登録する画像<br>
            {{-- 画像入れ替える様に極小画像置いておく --}}
            <img class="featured_image" id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>
        @error('featured_image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('tags', 'タグ', ['class' => 'col-sm-1 control-label w-auto post-form']) !!}
    <div class="col post-form-col">
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
    {!! Form::label('categories', 'カテゴリー ', ['class' => 'col-sm-1 control-label w-auto post-form']) !!}
    <div class="col post-form-col">
        <div class="{{ $errors->has('categories.*') ? 'is-invalid' : '' }}">
            @if ($categories)
                @foreach ($categories as $key => $category)
                    <div class="form-check form-check-inline">
                        {!! Form::checkbox('categories[]', $key, null, ['class' => 'form-check-input', 'id' => 'category' . $key]) !!}
                        <label class="form-check-label" for="category{{ $key }}">{{ $category }}</label>
                    </div>
                @endforeach
            @else
                カテゴリー未登録
            @endif
        </div>
        @error('categories.*')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    {!! Form::label('features', '特集項目 ', ['class' => 'col-sm-1 control-label w-auto post-form']) !!}
    <div class="col post-form-col">
        <div class="{{ $errors->has('features.*') ? 'is-invalid' : '' }}">
            @if ($features)
                @foreach ($features as $key => $feature)
                    <div class="form-check form-check-inline">
                        {!! Form::checkbox('features[]', $key, null, ['class' => 'form-check-input', 'id' => 'feature' . $key]) !!}
                        <label class="form-check-label" for="feature{{ $key }}">{{ $feature }}</label>
                    </div>
                @endforeach
            @else
                特集項目未登録
            @endif
        </div>
        @error('features.*')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('is_public', '状態', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        @foreach (config('common.public_status') as $key => $value)
            <div class="form-check form-check-inline">
                {{ Form::radio('is_public', $key, null, [
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
    {{ Form::label('published_at', '公開日', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    <div class="col post-form-col">
        {{ Form::datetime('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i'), ['class' => 'form-control' . ($errors->has('published_at') ? ' is-invalid' : '')]) }}
        @error('published_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="d-flex justify-content-between mt-4">
    <div class="">
        {{ link_to_route('back.posts.index', '一覧へ', null, ['class' => 'btn btn-secondary']) }}
    </div>
    <div class="">
        <button id="admin-blog-preview-btn" class="btn btn-secondary" type="submit">プレビュー</button>
        <button type="button" class="btn btn-success" name="subbtn">保存</button>
    </div>
</div>
{{-- </form> --}}
<script>
    // プレビュー用
    var prevBtn = document.getElementById("admin-blog-preview-btn");
    prevBtn.addEventListener("click", function(e) {
        document.querySelector('input[name=body]').value = document.querySelector('.ql-editor').innerHTML;

        // stop sending
        e.preventDefault();

        // set variables
        var blogForm = document.getElementById("ansform");
        var defaultAction = blogForm.getAttribute("action");
        // var previewAction = defaultAction.replace("/store/", "/preview/");
        var previewAction = defaultAction.replace("/posts", "/preview/1");

        // rewrite action & submit
        blogForm.setAttribute("action", previewAction);
        blogForm.setAttribute("target", "_blank");

        blogForm.submit();

        // reset
        blogForm.setAttribute("action", defaultAction);
        blogForm.removeAttribute("target");
        // blogForm.removeAttribute("method");
        blogForm.setAttribute("method", "POST");

    });

    // 選択画像削除
    function unsetImage() {
        var obj = document.getElementById("featured_image");
        obj.value = null;
        document.getElementById('image_preview').style.display = 'none';
        document.getElementById('clear').style.display = 'none';
    }

    // 画像プレビュー
    function previewImage(obj) {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            document.getElementById('preview').src = fileReader.result;
            document.getElementById('image_preview').style.display = 'block';
            document.getElementById('clear').style.display = 'block';
        });
        fileReader.readAsDataURL(obj.files[0]);
    }

    // 回答フォームを送信
    document.ansform.subbtn.addEventListener('click', function() {
        document.querySelector('input[name=body]').value = document.querySelector('.ql-editor').innerHTML;
        // 送信
        document.ansform.submit();
    });

    $(function() {
        var $title_textarea = $('#title_textarea');
        var lineHeight = parseInt($title_textarea.css('lineHeight'));
        $title_textarea.on('input', function(e) {
            var lines = ($(this).val() + '\n').match(/\n/g).length;
            $(this).height(lineHeight * lines);
        });
    });
    $(function() {
        var $description_textarea = $('#description_textarea');
        var lineHeight = parseInt($description_textarea.css('lineHeight'));
        $description_textarea.on('input', function(e) {
            var lines = ($(this).val() + '\n').match(/\n/g).length;
            $(this).height(lineHeight * lines);
        });
    });

    $(function() {
        $('#description_textarea')
            .on('change keyup keydown paste cut', function() {
                if ($(this).outerHeight() > this.scrollHeight) {
                    $(this).height(1)
                }
                while ($(this).outerHeight() < this.scrollHeight) {
                    $(this).height($(this).height() + 1)
                }
            }).trigger('change');
    });

    $(function() {
        $('#title_textarea')
            .on('change keydown paste cut', function() {
                if ($(this).outerHeight() > this.scrollHeight) {
                    $(this).height(1)
                }
                while ($(this).outerHeight() < this.scrollHeight) {
                    $(this).height($(this).height() + 1)
                }
            }).trigger('change');
    });
</script>
