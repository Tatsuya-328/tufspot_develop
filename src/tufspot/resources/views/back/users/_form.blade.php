<?php
/**
 * @var \App\Models\User $user
 */
?>
<script>
    var cropper = null;

    // 選択画像削除
    function unsetImage() {
        var obj = document.getElementById("image_input");
        obj.value = null;
        document.getElementById('image_preview').style.display = 'none';
        document.getElementById('cropped_image_preview').style.display = 'none';
        document.getElementById('clear').style.display = 'none';
    }

    // 画像プレビュー
    function previewImage(obj) {
        document.getElementById('image_preview').style.display = 'block';
        document.getElementById('cropped_image_preview').style.display = 'block';
        document.getElementById('clear').style.display = 'block';

        if (cropper) {
            cropper.destroy();
        }

        const fileReader = new FileReader();
        fileReader.readAsDataURL(obj.files[0]);
        fileReader.onload = () => {
            const croppingTargetImg = document.getElementById('cropping_target_image');
            croppingTargetImg.src = String(fileReader.result);
            cropper = new Cropper(croppingTargetImg, {
                aspectRatio: 1,
                autoCropArea: 1,
                viewMode: 1,
                ready: function() {
                    croppable = true;
                },
                crop(event) {
                    let croppedCanvas = cropper.getCroppedCanvas();
                    let roundedCanvas = getRoundedCanvas(croppedCanvas);
                    document.getElementById('preview_featured_image').src = roundedCanvas.toDataURL('image/webp');
                    roundedCanvas.toBlob(function(imgBlob) {
                        let croppedFile = new File([imgBlob], 'uploadded.webp', {
                            type: "image/webp"
                        });

                        let dataTransfer = new DataTransfer();
                        dataTransfer.items.add(croppedFile);
                        document.getElementById('image_input').files = dataTransfer.files;
                    });
                },
            });
        };
    }

    function getRoundedCanvas(sourceCanvas) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var width = sourceCanvas.width;
        var height = sourceCanvas.height;

        canvas.width = width;
        canvas.height = height;
        context.imageSmoothingEnabled = true;
        context.drawImage(sourceCanvas, 0, 0, width, height);
        context.globalCompositeOperation = 'destination-in';
        context.beginPath();
        context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
        context.fill();
        return canvas;
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
        {{ Form::select('role', Auth::user()->role === 2 ? [2 => '執筆者'] : config('common.user.roles'), null, ['class' => 'form-control']) }}
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
        @if ($user['profile_image_path'])
            <img loading="lazy" class="featured_image form-control" src="{{ asset($user['profile_image_path']) }}" alt="">
        @else
            <div class="form-control">
                画像未登録
            </div>
        @endif
        {{--
        <input type="file" class="form-control mt-3 mb-3" name="featured_image" value="{{ old('featured_image') }}" onchange="previewImage(this);">
        <div class="image_preview" id="image_preview" style="display: none">
            <img loading="lazy" class="featured_image" class="mt-3" id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>
        <input type="button" class="m-3" id="clear" value="登録解除" onclick="unsetImage();" style="display: none">
        --}}
    </div>
</div>

<div class="row">
    {{ Form::label('featured_image', '画像変更', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col post-form-col">
        <input type="file" class="form-control mb-3" id="image_input" name="featured_image" value="{{ old('featured_image') }}" onchange="previewImage(this);" />
        <div id="preview_image_container">
            <div class="image_preview" id="image_preview" style="display: none;">
                {{-- 画像入れ替える様に極小画像置いておく --}}
                <img loading="lazy" class="featured_image form-control" class="mt-3" id="preview_featured_image" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="display: block;" />
            </div>
            <div id="cropped_image_preview" style="display: none;">
                <img id="cropping_target_image" style="display: none;" />
            </div>
        </div>
        <input type="button" class="m-3 btn btn-outline-dark" id="clear" value="登録解除" onclick="unsetImage();" style="display: none;" />

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
