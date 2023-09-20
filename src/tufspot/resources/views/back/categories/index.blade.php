<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Category[] $categories
 */
$title = 'カテゴリー一覧';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {{ link_to_route('back.categories.create', '新規登録', null, ['class' => 'btn btn-primary mb-3']) }}
        @if (0 < $categories->count())
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">カテゴリー名</th>
                        <th scope="col">スラッグ</th>
                        <th scope="col" style="width: 12em">編集</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="d-flex justify-content-center">
                                {{ link_to_route('back.categories.edit', '編集', $category, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                ]) }}
                                {{ Form::model($category, [
                                    'route' => ['back.categories.destroy', $category],
                                    'method' => 'delete',
                                ]) }}
                                {{ Form::submit('削除', [
                                    'onclick' => "return confirm('本当に削除しますか?')",
                                    'class' => 'btn btn-danger btn-sm m-1',
                                ]) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
