<?php
/**
 * @var \App\Models\User $user
 */
$title = 'ユーザー編集';
?>
@extends('back.layouts.base')

@section('content')
    {!! Form::model($user, [
        'route' => ['back.users.update', $user],
        'method' => 'put',
        'files' => true,
        'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <button type="submit" class="btn btn-success" name="headsubbtn">保存</button>
    </div>
    @include('back.users._form')
    {!! Form::close() !!}
    <table class="table">
        <tr>
            <th>登録日時</th>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <th>編集日時</th>
            <td>{{ $user->updated_at }}</td>
        </tr>
    </table>
    </div>
@endsection
