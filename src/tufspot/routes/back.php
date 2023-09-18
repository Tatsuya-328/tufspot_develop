<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\PostController;

Route::get('/', 'DashboardController')->name('dashboard');
Route::resource('posts', 'PostController')->except('show');
Route::resource('tags', 'TagController')->except('show');
Route::resource('categories', 'CategoryController')->except('show');

// 記事プレビュー TODO(adminユーザーのみ)
Route::put('preview/{id}', [PostController::class, 'preview'])->name('article_preview');
Route::post('preview/{id}', [PostController::class, 'preview'])->name('article_preview');

// adminのみアクセス可能
Route::group(['middleware' => 'can:admin'], function () {
    Route::resource('users', 'UserController')->except('show');
});
