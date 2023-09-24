<?php
/**
 * @var \App\Models\Category $feature
 */
$title = '特集記事登録';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {{ Form::open(['route' => 'back.features.store']) }}
        @include('back.features._form')
        {{ Form::close() }}
    </div>
@endsection
