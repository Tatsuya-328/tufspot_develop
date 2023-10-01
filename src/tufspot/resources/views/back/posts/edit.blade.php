<?php
/**
 * @var \App\Models\Post $post
 */
$title = '投稿編集';
?>
@extends('back.layouts.base')

@section('content')
    {!! Form::model($post, [
        'name' => 'ansform',
        'id' => 'ansform',
        'method' => 'put',
        'route' => ['back.posts.update', $post],
        'files' => true,
        'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <button type="button" class="btn btn-success" name="headsubbtn">保存</button>
    </div>
    @include('back.posts._form')
    {!! Form::close() !!}
    <table class="table">
        <tr>
            <th>編集者</th>
            <td>{{ $post->user->name }}</td>
        </tr>
        <tr>
            <th>登録日時</th>
            <td>{{ $post->created_at }}</td>
        </tr>
        <tr>
            <th>編集日時</th>
            <td>{{ $post->updated_at }}</td>
        </tr>
    </table>
@endsection
