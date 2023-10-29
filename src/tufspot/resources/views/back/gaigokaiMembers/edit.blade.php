<?php
/**
 * @var \App\Models\GaigokaiMember $gaigokaiMember
 */
$title = '外語会 ID 編集';
?>
@extends('back.layouts.base')

@section('content')
    {!! Form::model($gaigokaiMember, [
        'route' => ['back.gaigokaiMembers.update', $gaigokaiMember],
        'method' => 'put',
        'files' => true,
        'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>
    @include('back.gaigokaiMembers._form')
    {!! Form::close() !!}
    <table class="table">
        <tr>
            <th>登録日時</th>
            <td>{{ $gaigokaiMember->created_at ?? '（初期登録されています）' }}</td>
        </tr>
        <tr>
            <th>編集日時</th>
            <td>{{ $gaigokaiMember->updated_at ?? '（編集されていません）' }}</td>
        </tr>
    </table>
    </div>
@endsection
