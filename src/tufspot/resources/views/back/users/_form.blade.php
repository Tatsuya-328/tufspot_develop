<?php
/**
 * @var \App\Models\User $user
 */
?>
<div class="form-group row">
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
<label for="input" class="col-sm-2 col-form-label">SNS</label>


@if (!empty($user['snsAccounts'][0]))
    <div class="form-group row" id="form-group">
        {{-- <div id="form_area"> --}}
        {{-- <div class="form-group"> --}}
        @foreach ($user['snsAccounts'] as $snsAccount)
            <input type="hidden" name="alreadySnsAccounts[{{ $loop->iteration }}]['id']" value="{{ $snsAccount['id'] }}" />
            <div class="col-sm-5" id="form_area{{ $loop->iteration }}">
                <input type="text" class="form-control col-sm-11" name="alreadySnsAccounts[{{ $loop->iteration }}][name]" value="{{ $snsAccount['name'] }}" />
            </div>
            <div class="col-sm-5" id="form_area{{ $loop->iteration }}">
                <input type="text" class="form-control col-sm-11" name="alreadySnsAccounts[{{ $loop->iteration }}][url]" value="{{ $snsAccount['url'] }}" />
            </div>
            <div class="bt_deleteForm col-sm-2">
                <input type="button" value="削除" class="formRemove" onclick="removeForm(this)">
            </div>
            @php
                $cnt = $loop->iteration;
            @endphp
        @endforeach
    </div>
    <input type="button" class="btn btn-info" value="追加" onclick="addForm({{ $cnt }})" />
@else
    <div class="form-group row" id="form-group">
        {{-- <div id="form_area"> --}}
        {{-- <div class="form-group"> --}}
        <div class="col-sm-5" id="form_area1">
            <input type="text" class="form-control col-sm-11" name="newSnsAccounts[1][name]" value="" />
        </div>
        <div class="col-sm-5" id="form_area2">
            <input type="text" class="form-control col-sm-11" name="newSnsAccounts[1][url]" value="" />
        </div>
        <div class="bt_deleteForm col-sm-2">
            <input type="button" value="削除" class="formRemove" onclick="removeForm(this)">
        </div>
    </div>
    <input type="button" class="btn btn-info" value="追加" onclick="addForm(1)" />
@endif

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

    function addForm(Cnt) {
        var Cnt = Cnt + 1;
        // var Cnt2 = Cnt + 1;
        // let Cnt2 = Cnt + 1
        // id属性で要素を取得
        let textbox_element = document.getElementById('form-group');
        // let textbox_element2 = document.getElementById('form_area' + Cnt2);

        // 新しいHTML要素を作成
        // let new_element = document.createElement('p');
        // new_element.textContent = '';
        // const createElement = '<div>追加テキスト</div>';
        const createElement = '<div class="col-sm-5" id="form_area' + Cnt +
            '"><input type="text" class="form-control col-sm-11" name="newSnsAccounts[' + Cnt +
            '][name]" value="" /> </div> <div class = "col-sm-5"id = "form_area' + Cnt +
            '" ><input type = "text"class = "form-control col-sm-11"name = "newSnsAccounts[' + Cnt +
            '][url]"value = "" / ></div>    <div class="bt_deleteForm col-sm-2">   <input type="button" value="削除" class="formRemove"  onclick="removeForm(this)" ></div>';
        // 指定した要素の中の末尾に挿入
        // textbox_element.appendChild(createElement);
        // textbox_element2.appendChild(new_element);
        textbox_element.insertAdjacentHTML('beforeend', createElement);
    }

    function removeForm(e) {
        // var button = document.getElementsByClassName('formRemove');
        // for (i = 0; i < button.length; i++) {
        //     console.log(button);
        // button[i].addEventListener("click", function() {
        e.parentNode.previousElementSibling.remove();
        e.parentNode.previousElementSibling.remove();
        e.parentNode.remove();
        e.remove();
        // this.parentNode.previousElementSibling.previousElementSibling.remove();
        // });
        // }
    }
</script>
