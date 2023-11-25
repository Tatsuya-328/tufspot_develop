<?php
/**
 * @var \App\Models\GaigokaiMember $gaigokaiMember
 */
$title = '外語会 ID 登録';
?>
@extends('back.layouts.base')

@section('content')
    {!! Form::open([
        'method' => 'post',
        'route' => 'back.gaigokaiMembers.store',
    ]) !!}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>
    @include('back.gaigokaiMembers._form')

    {!! Form::close() !!}
@endsection
