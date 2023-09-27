<?php
/**
 * @var \App\Models\Category $feature
 */
$title = '特集記事編集';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {!! Form::model($feature, [
            'route' => ['back.features.update', $feature],
            'method' => 'put',
        ]) !!}
        @include('back.features._form')
        {!! Form::close() !!}
        <table class="table">
            <tr>
                <th>登録日時</th>
                <td>{{ $feature->created_at }}</td>
            </tr>
            <tr>
                <th>編集日時</th>
                <td>{{ $feature->updated_at }}</td>
            </tr>
        </table>
    </div>
@endsection
