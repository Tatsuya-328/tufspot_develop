<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\User[] $users
 */
$title = 'ユーザー一覧';
?>
@extends('back.layouts.base')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        {{-- TODO: 管理者追加もエンドユーザー側からやってもらう仮定。仮の外語会IDを付与してLaravelUIから登録？ --}}
        {{-- <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('back.users.create') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill v" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>
                登録
            </a>
        </div> --}}
    </div>
    @if (0 < $users->count())
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col" style="width: 2em" class="text-nowrap">ID</th>
                        <th scope="col" style="width: 10em" class="text-nowrap">ユーザー名</th>
                        <th scope="col" style="width: 10em" class="text-nowrap">メールアドレス</th>
                        <th scope="col" style="width: 5em" class="text-nowrap">権限</th>
                        <th scope="col" style="width: 5em" class="text-nowrap"></th>
                        <th scope="col" style=""></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role_label }}</td>
                            <td>
                                {{ link_to_route('back.users.edit', '編集', $user, [
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
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        {{-- <li><a class="dropdown-item" href="{{ route('user_detail', ['user', $user->slug]) }}">本番確認</a></li> --}}
                                        <li>
                                            {{ Form::model($user, [
                                                'route' => ['back.users.destroy', $user],
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
                    {{ $users->links() }}
                </ul>
            </nav>
        </div>
    @endif
    </div>
@endsection




{{-- 
@if (0 < $users->count())
    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ユーザー名</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">権限</th>
                <th scope="col" style="width: 12em">編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_label }}</td>
                    <td class="d-flex justify-content-center">
                        {{ link_to_route('back.users.edit', '編集', $user, [
                            'class' => 'btn btn-secondary btn-sm m-1',
                        ]) }}
                        {{ Form::model($user, [
                            'route' => ['back.users.destroy', $user],
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
        {{ $users->links() }}
    </div>
@endif
</div>
@endsection --}}
