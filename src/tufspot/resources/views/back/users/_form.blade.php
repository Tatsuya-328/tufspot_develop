<?php
/**
 * @var \App\Models\User $user
 */
?>
<div class="form-group row">
    {{ Form::label('name', 'ユーザー名', ['class' => 'col-sm-2 col-form-label']) }}
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

<div class="form-group row">
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

<div class="form-group row">
    {{ Form::label('role', '権限', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::select('role', config('common.user.roles'), null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('profile_image', 'プロフィール画像', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        @if ($user['profile_image_path'])
            既存<br>
            <img class="featured_image" src="{{ asset($user->profile_image_path) }}" alt="">
        @endif
        <input type="file" class="form-control" name="profile_image" id="profile_image" value="{{ old('profile_image') }}" onchange="previewImage(this);">
        <input type="button" id="clear" value="画像選択解除" onclick="test();" style="display: none">
        <div class="image_preview" id="image_preview" style="display: none">
            変更する画像<br>
            <img class="featured_image" id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>

        @error('profile_image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('introduction', '自己紹介', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::text('introduction', null, [
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

<div class="form-group row">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">保存</button>
        {{ link_to_route('back.users.index', '一覧へ戻る', null, ['class' => 'btn btn-secondary']) }}
    </div>
</div>

<script>
    function test() {
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
</script>
