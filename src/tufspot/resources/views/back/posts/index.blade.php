<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts
 */
$title = '投稿一覧';
?>
@extends('back.layouts.base')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            {{ link_to_route('back.posts.create', '新規登録', null, ['class' => 'btn btn-primary']) }}
            {{-- <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div> --}}
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                This week
            </button> --}}
        </div>
    </div>
    {{-- <h1>{{ $title }}</h1> --}}
    <div class="">
        {!! Form::model($search, [
            'route' => 'back.posts.index',
            'method' => 'get',
            'class' => 'mb-5 mt-5',
        ]) !!}
        <div class="row align-items-center mb-2">
            <div class="col">
                {{ Form::select('user_id', $users, null, [
                    'class' => 'custom-select',
                    'placeholder' => 'ユーザー',
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col">
                {{ Form::select('is_public', config('common.public_status'), null, [
                    'class' => 'custom-select',
                    'placeholder' => '公開状態',
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col">
                {{ Form::select('category_id', $categories, null, [
                    'class' => 'custom-select',
                    'placeholder' => 'カテゴリー',
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col">
                {{ Form::select('feature_id', $features, null, [
                    'class' => 'custom-select',
                    'placeholder' => '特集項目',
                    'class' => 'form-select',
                ]) }}
            </div>
            <div class="col">
                {{ Form::select('tag_id', $tags, null, [
                    'class' => 'custom-select',
                    'placeholder' => 'タグ',
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="col-md-6">
                {{ Form::text('title', null, [
                    'class' => 'form-control',
                    'placeholder' => 'タイトル',
                ]) }}
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>

        </div>
        {{ Form::close() }}

        @if (0 < $posts->count())
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">タイトル</th>
                        <th scope="col" style="width: 5em">状態</th>
                        <th scope="col" style="width: 10em">カテゴリー</th>
                        <th scope="col" style="width: 10em">特集項目</th>
                        <th scope="col" style="width: 10em">公開日</th>
                        <th scope="col" style="width: 10em">執筆者</th>
                        <th scope="col" style="width: 15em"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->is_public_label }}</td>
                            <td>
                                @foreach ($post->categories as $category)
                                    @if (!$loop->first)
                                        、
                                    @endif
                                    {{ $category->name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($post->features as $feature)
                                    @if (!$loop->first)
                                        、
                                    @endif
                                    {{ $feature->name }}
                                @endforeach
                            </td>
                            <td>{{ $post->published_format }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td class="d-flex justify-content-center">
                                {{ link_to_route('post_detail', '本番確認', $post, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                    'target' => '_blank',
                                ]) }}
                                {{-- {{ link_to_route('index', '詳細', $post, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                {{ link_to_route('back.posts.edit', '編集', $post, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                ]) }}
                                {{ Form::model($post, [
                                    'route' => ['back.posts.destroy', $post],
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
                {{ $posts->appends($search)->links() }}
            </div>
        @endif
    </div>
@endsection
