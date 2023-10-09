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

@if (!Request::is('admin/posts/create'))
    <div class="row mb-3">
        {{ Form::label('featured_image', 'アイキャッチ', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
        <div class="col post-form-col">
            @if ($post['featured_image_path'])
                <img class="featured_image form-control" src="{{ asset($post->featured_image_path) }}" alt="">
            @else
                <div class="form-control">
                    画像未登録
                </div>
            @endif
            {{-- <input type="file" class="form-control mt-3 mb-3" name="featured_image" value="{{ old('featured_image') }}" onchange="previewImage(this);">
        <div class="image_preview" id="image_preview" style="display: none">
            <img class="featured_image" class="mt-3" id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>
        <input type="button" class="mt-3" id="clear" value="登録解除" onclick="unsetImage();" style="display: none"> --}}
        </div>
    </div>
@endif

<div class="row mb-2">
    @if (!Request::is('admin/posts/create'))
        {{ Form::label('featured_image', '画像変更', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    @else
        {{ Form::label('featured_image', 'アイキャッチ', ['class' => 'col-sm-1 col-form-label w-auto post-form']) }}
    @endif
    <div class="col post-form-col">
        <input type="file" class="form-control mb-3" id="image_input" name="featured_image" value="{{ old('featured_image') }}" onchange="previewImage(this);">
        <div class="image_preview" id="image_preview" style="display: none">
            {{-- 画像入れ替える様に極小画像置いておく --}}
            <img class="featured_image form-control" class="mt-3" id="preview_featured_image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>
        <input type="button" class="mt-3 btn btn-outline-dark" id="clear" value="選択解除" onclick="unsetImage();" style="display: none">

        @error('featured_image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row mt-4">
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
                <div class="form-control">
                    タグ未登録
                </div>
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
                <div class="form-control">
                    カテゴリー未登録
                </div>
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
                <div class="form-control">
                    特集項目未登録
                </div>
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
    {{ Form::label('is_public', '状態', ['class' => 'col-sm-1 control-label w-auto post-form']) }}
    <div class="col post-form-col">
        @foreach (config('common.public_status') as $key => $value)
            <div class="form-check form-check-inline">
                {{ Form::radio('is_public', $key, null, [
                    'id' => 'is_public' . $key,
                    'class' => 'form-check-input' . ($errors->has('is_public') ? ' is-invalid' : ''),
                ]) }}
                {{ Form::label('is_public' . $key, $value, ['class' => 'form-check-label']) }}
                @if ($key === 2)
                    <input type="date" name="date" class="form-control">
                    <div class="d-flex align-items-center">
                        <select name="hour" id="hour" class="form-select me-2">
                            @for ($i = 0; $i < 24; $i++)
                                <option value="{{ $i < 10 ? '0' . $i : $i }}">{{ $i < 10 ? '0' . $i : $i }}</option>
                            @endfor
                        </select>
                        <span>時</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <select name="min" id="min" class="form-select me-2">
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <span>分</span>
                    </div>
                    @error('is_public')
                        <div class="text-danger form-check form-check-inline">
                            {{ $message }}
                        </div>
                    @enderror
                @endif
                {{-- @if ($key === 1)
                    @error('is_public')
                        <div class="text-danger form-check form-check-inline">
                            {{ $message }}
                        </div>
                    @enderror
                @endif --}}
            </div>
        @endforeach
    </div>
</div>

{{-- <div class="form-group row">
    {{ Form::label('published_at', '公開日', ['class' => 'col-sm-1 control-label w-auto post-form']) }}
    <div class="col post-form-col"> --}}
{{ Form::datetime('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i'), ['class' => 'form-control visually-hidden' . ($errors->has('published_at') ? ' is-invalid' : '')]) }}
{{-- @error('published_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}

<div class="d-flex justify-content-between mt-4 mb-4">
    <div class="">
        {{ link_to_route('back.posts.index', '一覧へ', null, ['class' => 'btn btn-outline-dark']) }}
    </div>
    <div class="">
        <button id="admin-blog-preview-btn" class="btn btn-outline-dark" type="submit">プレビュー</button>
        <button type="button" class="btn btn-success" name="subbtn">保存</button>
    </div>
</div>
{{-- </form> --}}
<script>
    // 画面遷移時の保存警告
    changeFlg = true;
    $(function() {
        $(window).on('beforeunload', function() {
            if (changeFlg) {
                // ブラウザデフォルトメッセージ表示
                return '投稿が完了していません。このまま移動しますか？';
            }
        });
    });

    // プレビュー用
    var prevBtn = document.getElementById("admin-blog-preview-btn");
    prevBtn.addEventListener("click", function(e) {
        changeFlg = false;

        document.querySelector('input[name=body]').value = document.querySelector('.ql-editor').innerHTML;

        // stop sending
        e.preventDefault();

        // set variables
        var blogForm = document.getElementById("ansform");
        var defaultAction = blogForm.getAttribute("action");
        // var previewAction = defaultAction.replace("/store/", "/preview/");
        if (document.URL.match("edit")) {
            var previewAction = defaultAction.replace("/posts", "/preview");
        } else {
            var previewAction = defaultAction.replace("/posts", "/preview/1");
        }
        // rewrite action & submit
        blogForm.setAttribute("action", previewAction);
        blogForm.setAttribute("target", "_blank");

        blogForm.submit();

        // reset
        blogForm.setAttribute("action", defaultAction);
        blogForm.removeAttribute("target");
        // blogForm.removeAttribute("method");
        blogForm.setAttribute("method", "POST");
        changeFlg = true;
    });

    // 選択画像削除
    function unsetImage() {
        var obj = document.getElementById("image_input");
        obj.value = null;
        document.getElementById('image_preview').style.display = 'none';
        document.getElementById('clear').style.display = 'none';
    }

    // 画像プレビュー
    function previewImage(obj) {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            document.getElementById('preview_featured_image').src = fileReader.result;
            document.getElementById('image_preview').style.display = 'block';
            document.getElementById('clear').style.display = 'block';
        });
        fileReader.readAsDataURL(obj.files[0]);
    }

    // 回答フォームを送信
    document.ansform.subbtn.addEventListener('click', function() {
        let condition = $('[name="is_public"]:checked').val();
        if (condition === '0') {
            window.confirm("公開状態は以下で間違いないですか？\n状態：下書き");
        } else if (condition === '1') {
            window.confirm("公開状態は以下で間違いないですか？\n状態：公開");
        } else if (condition === '2') {
            window.confirm("公開状態は以下で間違いないですか？\n状態：予約投稿");
        } else {
            window.confirm("公開状態が選択されていません。");
        }
        changeFlg = false;
        document.querySelector('input[name=body]').value = document.querySelector('.ql-editor').innerHTML;
        document.ansform.submit();
    });
    // ページ上部のボタン送信
    document.ansform.headsubbtn.addEventListener('click', function() {
        let condition = $('[name="is_public"]:checked').val();
        if (condition === '0') {
            window.confirm("公開状態は以下で間違いないですか？\n下書き");
        } else if (condition === '1') {
            window.confirm("公開状態は以下で間違いないですか？\n公開");
        } else if (condition === '2') {
            window.confirm("公開状態は以下で間違いないですか？\n予約投稿");
        } else {
            window.confirm("公開状態が選択されていません。");
        }
        changeFlg = false;
        document.querySelector('input[name=body]').value = document.querySelector('.ql-editor').innerHTML;
        document.ansform.submit();
    });

    // テキストエリアの伸縮
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

    // テキストエリアの伸縮
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
