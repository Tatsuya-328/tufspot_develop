<?php
/**
 * @var \App\Models\GaigokaiMember $gaigokaiMember
 */
?>
<div class="form-group row mb-2">
    {{ Form::label('id', '外語会 ID', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::text('id', null, [
            'class' => 'form-control' . ($errors->has('id') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row mb-2">
    {{ Form::label('phone_number', '電話番号', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::text('phone_number', null, [
            'class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('phone_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="d-flex justify-content-between mt-4 mb-4">
    <div class="">
        {{ link_to_route('back.gaigokaiMembers.index', '一覧へ', null, ['class' => 'btn btn-outline-dark']) }}
    </div>
    <div class="">
        <button type="submit" class="btn btn-success" name="subbtn">保存</button>
    </div>
</div>
