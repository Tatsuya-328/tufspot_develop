<?php
/**
 * @var \App\Models\User $user
 */
?>
<div class="form-group row mb-2">
    {{ Form::label('name', 'ユーザー名', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        <input type="hidden" name="user_id" value="{{ $user['id'] }}" />
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
    {{ Form::label('role', '権限', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::select('role', config('common.user.roles'), null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row mb-2">
    {{ Form::label('email', 'メールアドレス', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::email('email', null, [
            'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row mb-5">
    {{ Form::label('password', 'パスワード', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::password('password', [
            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
        ]) }}
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row mb-2">
    {{ Form::label('introduction', '自己紹介', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('introduction', null, [
            'class' => 'form-control' . ($errors->has('introduction') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('introduction')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row mb-2">
    {{ Form::label('featured_image', 'アイコン画像', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col post-form-col">
        @if ($user['featured_image_path'])
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

<div class="row">
    {{ Form::label('featured_image', '画像変更', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col post-form-col">
        <input type="file" class="form-control mb-3" id="image_input" name="featured_image" value="{{ old('featured_image') }}" onchange="previewImage(this);">
        <div class="image_preview" id="image_preview" style="display: none">
            {{-- 画像入れ替える様に極小画像置いておく --}}
            <img class="featured_image form-control" class="mt-3" id="preview_featured_image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>
        <input type="button" class="mt-3 btn btn-outline-dark" id="clear" value="登録解除" onclick="unsetImage();" style="display: none">

        @error('featured_image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

@if (!empty($user['snsAccounts'][0]))

    <div class="mb-4 row">
        <label for="input" class="col-sm-2 col-form-label">SNS</label>
        <div id="form-group" class="w-100">
            <div class="d-flex ms-1">
                @foreach ($user['snsAccounts'] as $snsAccount)
                    <input type="hidden" name="alreadySnsAccounts[{{ $loop->iteration }}]['id']" value="{{ $snsAccount['id'] }}" />
                    <div class="me-2" id="form_area{{ $loop->iteration }}">
                        <input type="text" class="form-control" name="alreadySnsAccounts[{{ $loop->iteration }}][name]" value="{{ $snsAccount['name'] }}" />
                    </div>
                    <div class="me-2" id="form_area{{ $loop->iteration }}">
                        <input type="text" class="form-control" name="alreadySnsAccounts[{{ $loop->iteration }}][url]" value="{{ $snsAccount['url'] }}" />
                    </div>
                    <div class="bt_deleteForm col-sm-2">
                        <input type="button" value="削除" class="formRemove btn btn-outline-dark" onclick="removeForm(this)">
                    </div>
                    @php
                        $cnt = $loop->iteration;
                    @endphp
                @endforeach
            </div>
        </div>
        <input type="button" class="btn btn-outline-dark h-25 align-self-end" value="追加" onclick="addForm({{ $cnt }})" />
    </div>
@else
    <div class="mb-2 row">
        <label for="input" class="col-sm-2 col-form-label">SNS</label>
        {{-- <div id="form-group" class="col post-form-col"> --}}
        <div class="col row" id="form-group">
            <div class="col-sm-3" id="form_area1">
                <input type="text" class="form-control" name="newSnsAccounts[1][name]" value="" placeholder="Instagram" />
            </div>
            <div class="col-sm-7" id="form_area2">
                <input type="text" class="form-control" name="newSnsAccounts[1][url]" value="" placeholder="https://www.instagram.com" />
            </div>
            <div class="bt_deleteForm">
                <input type="button" value="削除" class="formRemove btn btn-outline-dark" onclick="removeForm(this)">
            </div>
            {{-- <div class="bt_deleteForm">
                <input type="button" class="btn btn-outline-dark align-self-end" value="追加" onclick="addForm(1)" />
            </div> --}}
        </div>
        {{-- </div> --}}
        {{-- <div class="col-sm-1"> --}}
    </div>
    <div class="d-flex justify-content-end mb-4">
        <input type="button" class="btn btn-outline-dark" value="追加" onclick="addForm(1)" />
    </div>
    {{-- </div> --}}

@endif


<div class="d-flex justify-content-between mt-4 mb-4">
    <div class="">
        {{ link_to_route('back.users.index', '一覧へ', null, ['class' => 'btn btn-outline-dark']) }}
    </div>
    <div class="">
        <button type="submit" class="btn btn-success" name="subbtn">保存</button>
    </div>
</div>
<script>
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

    // form追加
    function addForm(Cnt) {
        var Cnt = Cnt + 1;
        let textbox_element = document.getElementById('form-group');
        const createElement = '<div class="col-sm-3 mt-1" id="form_area' + Cnt +
            '"><input type="text" class="form-control " name="newSnsAccounts[' + Cnt +
            '][name]" value="" placeholder="Instagram" /> </div> <div class = "col-sm-7 mt-1"id = "form_area' + Cnt +
            '" ><input type = "text"class = "form-control "name = "newSnsAccounts[' + Cnt +
            '][url]"value = "" placeholder="https://www.instagram.com" / ></div>    <div class="bt_deleteForm col-sm-2">   <input type="button" value="削除" class="formRemove btn btn-outline-dark"  onclick="removeForm(this)" ></div>';
        // 指定した要素の中の末尾に挿入
        textbox_element.insertAdjacentHTML('beforeend', createElement);
    }

    // form削除
    function removeForm(e) {
        e.parentNode.previousElementSibling.remove();
        e.parentNode.previousElementSibling.remove();
        // e.parentNode.parentNode.remove();
        e.parentNode.remove();
        e.remove();
    }
</script>
