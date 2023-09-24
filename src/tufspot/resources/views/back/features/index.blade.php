<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Category[] $features
 */
$title = '特集記事一覧';
?>
@extends('back.layouts.base')

@section('content')
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        {{ link_to_route('back.features.create', '新規登録', null, ['class' => 'btn btn-primary mb-3']) }}
        @if (0 < $features->count())
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">カテゴリー名</th>
                        <th scope="col">スラッグ(URL名)</th>
                        <th scope="col" style="width: 12em">編集(記事選択)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($features as $feature)
                        <tr>
                            <td>{{ $feature->id }}</td>
                            <td>{{ $feature->name }}</td>
                            <td>{{ $feature->slug }}</td>
                            <td class="d-flex justify-content-center">
                                {{ link_to_route('back.features.edit', '編集', $feature, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                ]) }}
                                {{ Form::model($feature, [
                                    'route' => ['back.features.destroy', $feature],
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
                {{ $features->links() }}
            </div>
        @endif
    </div>
@endsection
