@extends('layouts.user')

@section('page-title')
    パスワード再設定完了
@endsection

@section('page-content')
    <div>
        <h1>パスワードリセットが完了しました</h1>

        <a href="{{ route('login') }}">TOPへ</a>
    </div>
@endsection
