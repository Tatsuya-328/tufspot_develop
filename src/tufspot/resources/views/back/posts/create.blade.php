<?php
/**
 * @var \App\Models\Post $post
 */
$title = '投稿登録';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {{-- {{ Form::open(['name' => 'ansform', 'id' => 'ansform', 'method' => 'put', 'route' => 'back.posts.store', 'files' => true, 'enctype' => 'multipart/form-data']) }} --}}
        {!! Form::open([
            'name' => 'ansform',
            'id' => 'ansform',
            'method' => 'post',
            'route' => 'back.posts.store',
            'files' => true,
            'enctype' => 'multipart/form-data',
        ]) !!}
        {{-- {!! Form::model($post, [
            'name' => 'ansform',
            'id' => 'ansform',
            'method' => 'put',
            'route' => ['back.posts.update', $post],
            'files' => true,
            'enctype' => 'multipart/form-data',
        ]) !!} --}}
        @include('back.posts._form')
        {{-- {{ Form::close() }} --}}
        {!! Form::close() !!}

    </div>
@endsection
