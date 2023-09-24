<?php
/**
 * @var \App\Models\Category $category
 */
$title = 'カテゴリー編集';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {!! Form::model($category, [
            'route' => ['back.categories.update', [$category]],
            'method' => 'put',
        ]) !!}
        @include('back.categories._form')
        {!! Form::close() !!}
        <table class="table">
            <tr>
                <th>登録日時</th>
                <td>{{ $category->created_at }}</td>
            </tr>
            <tr>
                <th>編集日時</th>
                <td>{{ $category->updated_at }}</td>
            </tr>
        </table>
    </div>
@endsection
