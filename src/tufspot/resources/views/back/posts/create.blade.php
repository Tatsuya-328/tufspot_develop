<?php
/**
 * @var \App\Models\Post $post
 */
$title = '投稿登録';
?>
@extends('back.layouts.base')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>
    <div class="">
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
