<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// })->name('index');
// Route::get('/top', function () {
//     return view('index');
// })->name('index');
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/top', [PostController::class, 'index'])->name('index');

// カテゴリー記事まとめ（Academiaのみ、や、〇〇特集のみ表示）
// TODO トップのAcademiaとかから遷移できるように
Route::get('/category_post', function () {
    return view('category_post');
})->name('category_post');

// 特集一覧（〇〇特集, ✖️✖️特集, △△特集,,,を全て表示して、それぞれのまとめへ遷移）
// TODO 特集項目を追加できるようにテーブル作成必要そう？
Route::get('/feature_list', function () {
    return view('feature_list');
})->name('feature_list');

// TODO：記事検索と、ハッシュタグ検索はほぼ同じ？
Route::get('/search_result', function () {
    return view('search_result');
})->name('search_result');

// Route::get('/hashtag_result/{id}', function () {
//     return view('hashtag_result');
// })->name('hashtag_result');
Route::get('/hashtag_result/{tagSlug}', [PostController::class, 'index'])->where('tagSlug', '[a-z]+')->name('hashtag_result');

// mypage
Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
Route::put('/mypage/update/{user}', [UserController::class, 'update'])->name('update');

// ライター一覧
Route::get('/writer', [UserController::class, 'list'])->name('writer_list');

// ライター詳細
Route::get('/writer/{user}', [UserController::class, 'show'])->name('writer_detail');

// 記事詳細
Route::get('/post/{id}', [PostController::class, 'show'])->name('post_detail');

// TUFSPOTについて
Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();
Route::get('/logout', [LoginController::class, 'logout']);

// TODO adminのURLに変更。特定ユーザーのみログイン可能に。
Route::get('/home', function () {
    return view('home');
})->name('home');
