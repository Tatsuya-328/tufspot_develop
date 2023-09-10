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
        {{ Form::open(['name' => 'ansform', 'route' => 'back.posts.store', 'files' => true]) }}
        @include('back.posts._form')
        {{ Form::close() }}
    </div>
@endsection
