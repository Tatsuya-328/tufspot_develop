<?php

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
Route::get('/hashtag_result/{id}', function () {
    return view('hashtag_result');
})->name('hashtag_result');
// mypage
Route::get('/mypage', function () {
    return view('mypage');
})->name('mypage');
// ライター一覧
Route::get('/writer', function () {
    return view('writer_list');
})->name('writer_list');
// ライター詳細
Route::get('/writer/detail/{id}', function () {
    return view('writer_detail');
})->name('writer_detail');
// 記事詳細
Route::get('/article/{id}', function () {
    return view('article_detail');
})->name('article_detail');
// TUFSPOTについて
Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
