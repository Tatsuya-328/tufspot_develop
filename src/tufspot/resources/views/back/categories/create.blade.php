<?php
/**
 * @var \App\Models\Category $category
 */
$title = 'カテゴリー登録';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {{ Form::open(['route' => 'back.categories.store']) }}
        @include('back.categories._form')
        {{ Form::close() }}
    </div>
@endsection
