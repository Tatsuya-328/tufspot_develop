<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Category[] $categories
 */
$title = 'カテゴリー一覧';
?>
@extends('back.layouts.base')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('back.categories.create') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill v" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>
                登録
            </a>
        </div>
    </div>
    @if (0 < $categories->count())
        {{-- <table class="table table-striped table-bordered table-hover table-sm"> --}}
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col" style="width: 2em" class="text-nowrap">ID</th>
                        <th scope="col" style="width: 12em" class="text-nowrap">カテゴリー名</th>
                        <th scope="col" style="width: 10em" class="text-nowrap">スラッグ(URL名)</th>
                        <th scope="col" style="width: 5em" class="text-nowrap">状態</th>
                        {{-- <th scope="col" style="width: 10em" class="text-nowrap">特集項目</th> --}}
                        {{-- <th scope="col" style="width: 10em" class="text-nowrap">公開日</th> --}}
                        {{-- <th scope="col" style="width: 10em" class="text-nowrap">執筆者</th> --}}
                        <th scope="col" style="width: 5em" class="text-nowrap"></th>
                        <th scope="col" style=""></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->is_public_label }}</td>
                            {{-- <td>
                                @foreach ($category->categories as $category)
                                    @if (!$loop->first)
                                        、
                                    @endif
                                    {{ $category->name }}
                                @endforeach
                            </td> --}}
                            {{-- <td>
                                @foreach ($category->features as $feature)
                                    @if (!$loop->first)
                                        、
                                    @endif
                                    {{ $feature->name }}
                                @endforeach
                            </td> --}}
                            {{-- <td>{{ $category->published_format }}</td> --}}
                            {{-- <td>{{ $category->user->name }}</td> --}}
                            <td>
                                {{-- {{ link_to_route('category_detail', '本番確認', $category, [
                                    'class' => 'btn btn-outline-dark btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                {{-- {{ link_to_route('index', '詳細', $category, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                {{ link_to_route('back.categories.edit', '編集', $category, [
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
                                        <li><a class="dropdown-item" href="{{ route('category_detail', ['category', $category->slug]) }}">本番確認</a></li>
                                        <li>
                                            {{ Form::model($category, [
                                                'route' => ['back.categories.destroy', $category],
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
                    {{-- {{ $categories->appends($search)->links() }} --}}
                    {{ $categories->links() }}
                </ul>
            </nav>
        </div>
    @endif
    </div>



    {{-- @if (0 < $categories->count())
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">カテゴリー名</th>
                    <th scope="col">スラッグ(URL名)</th>
                    <th scope="col" style="width: 12em">編集（記事選択）</th>
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
    </div> --}}
@endsection
