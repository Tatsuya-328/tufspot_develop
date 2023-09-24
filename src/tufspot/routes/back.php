<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\PostController;

// adminのみアクセス可能
Route::group(['middleware' => 'can:admin'], function () {
    // Route::get('/', 'DashboardController')->name('dashboard');
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::resource('posts', 'PostController')->except('show');
    Route::resource('tags', 'TagController')->except('show');
    Route::resource('categories', 'CategoryController')->except('show');
    Route::resource('features', 'FeatureController')->except('show');

    // 記事プレビュー
    Route::put('preview/{id}', [PostController::class, 'preview'])->name('post_preview');
    Route::post('preview/{id}', [PostController::class, 'preview'])->name('post_preview');
    Route::resource('users', 'UserController')->except('show');
});
