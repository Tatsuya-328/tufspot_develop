<?php
/**
 * @var \App\Models\Category $category
 */
$title = 'カテゴリー登録';
?>
@extends('back.layouts.base')

@section('content')
    {{ Form::open(['route' => 'back.categories.store']) }}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <button type="submit" class="btn btn-success" name="headsubbtn">保存</button>
    </div>
    @include('back.categories._form')
    {{ Form::close() }}
@endsection
