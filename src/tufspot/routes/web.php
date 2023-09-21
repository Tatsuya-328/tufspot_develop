<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\UserController;
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

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/top', function () {
    return view('index');
})->name('index');
// カテゴリー記事詳細
Route::get('/category_article', function () {
    return view('category_article');
})->name('category_article');
// カテゴリー一覧
Route::get('/category_list', function () {
    return view('category_list');
})->name('category_list');
// 中身同じ
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
Route::get('/writer', function () {
    return view('writer_list');
})->name('writer_list');

// ライター詳細
// Route::get('/writer/detail/{id}', function () {
//     return view('writer_detail');
// })->name('writer_detail');
Route::get('/writer/{user}', [UserController::class, 'show'])->name('writer_detail');
// Route::resource('writer', [UserController::class]);

// 記事詳細
// Route::get('/article/{id}', function () {
//     return view('article_detail');
// })->name('article_detail');
Route::get('/article/{id}', [PostController::class, 'show'])->name('article_detail');

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
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
