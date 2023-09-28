<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts
 */
$title = '記事一覧';
?>
@extends('back.layouts.base')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('back.posts.create') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill v" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>登録</a>
        </div>
    </div>
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
                <button type="submit" class="btn btn-outline-dark">検索</button>
            </div>

        </div>
        {{ Form::close() }}

        @if (0 < $posts->count())
            {{-- <table class="table table-striped table-bordered table-hover table-sm"> --}}
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col" class="text-nowrap">ID</th>
                            <th scope="col" style="width: 15em" class="text-nowrap">タイトル</th>
                            <th scope="col" style="width: 5em" class="text-nowrap">状態</th>
                            <th scope="col" style="width: 10em" class="text-nowrap">カテゴリー</th>
                            <th scope="col" style="width: 10em" class="text-nowrap">特集項目</th>
                            <th scope="col" style="width: 10em" class="text-nowrap">公開日</th>
                            <th scope="col" style="width: 10em" class="text-nowrap">執筆者</th>
                            <th scope="col" style="width: 5em" class="text-nowrap"></th>
                            <th scope="col" style=""></th>
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
                                <td>
                                    {{-- {{ link_to_route('post_detail', '本番確認', $post, [
                                    'class' => 'btn btn-outline-dark btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                    {{-- {{ link_to_route('index', '詳細', $post, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                    {{ link_to_route('back.posts.edit', '編集', $post, [
                                        'class' => 'btn btn-outline-dark btn-sm m-1',
                                    ]) }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="text-decoration-none link-dark pb-3" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                            </svg>
                                        </a>
                                        {{-- <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                    </button> --}}
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                            <li><a class="dropdown-item" href="{{ route('post_detail', [$post]) }}">本番確認</a></li>
                                            <li>
                                                {{ Form::model($post, [
                                                    'route' => ['back.posts.destroy', $post],
                                                    'method' => 'delete',
                                                ]) }}
                                                {{ Form::submit('削除', [
                                                    'onclick' => "return confirm('本当に削除しますか?')",
                                                    'class' => 'dropdown-item text-danger',
                                                ]) }}
                                                {{ Form::close() }}
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $posts->appends($search)->links() }}
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
