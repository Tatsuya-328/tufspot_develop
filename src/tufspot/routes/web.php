<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PasswordController;

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

// カテゴリ・特集自体一覧（〇〇特集, ✖️✖️特集, △△特集,,,を全て表示して、それぞれのまとめへ遷移）
// TODO テーブルはそれぞれ必要。同じ一覧で表示させるが、topでスライダーは特集ループ、グリッド表示はカテゴリーループのため
Route::get('/category', [PostController::class, 'category'])->name('category');


// 各カテゴリー記事一覧（Academiaのみ、や、〇〇特集のみ表示）
// TODO トップのAcademiaとかから遷移できるように
Route::get('/{type}/list/{slug}', [PostController::class, 'category_detail'])->name('category_detail');


// TODO 記事検索。Contorllerの関数も用意してない。bladeは簡易用意してあるけど、componentに変数渡さないとエラーなるはず（search_result.blade）
// TODO ハッシュタグ検索、これも用意してない。bladeを用意してあるけれど、serachとほぼ同じ内容だから、searchのblade共通で使って条件分岐の方が楽かも（hashtag_result.blade）
// routeの書き方も、contollerもbladeも自由にかえてOK。
// 追記）というかそもそも, serach_resultだけで事足りるかもしれない。
// http://localhost/admin の検索フォームが参考になるかと。これプラスで別画面遷移と、検索ワードやハッシュタグを表示させれればOK。
Route::get('/search_result', [PostController::class, 'search'])->name('search_result');
Route::get('/hashtag_result/{tagSlug}', [PostController::class, 'hashtag'])->name('hashtag_result');

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

// パスワードリセット関連
Route::prefix('password_reset')->name('password_reset.')->group(function () {
    Route::prefix('email')->name('email.')->group(function () {
        // パスワードリセットメール送信フォームページ
        Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
        // メール送信処理
        Route::post('/', [PasswordController::class, 'sendEmailResetPassword'])->name('send');
        // メール送信完了ページ
        Route::get('/send_complete', [PasswordController::class, 'sendComplete'])->name('send_complete');
    });
    // パスワード再設定ページ
    Route::get('/edit', [PasswordController::class, 'edit'])->name('edit');
    // パスワード更新処理
    Route::post('/update', [PasswordController::class, 'update'])->name('update');
    // パスワード更新終了ページ
    Route::get('/edited', [PasswordController::class, 'edited'])->name('edited');
});
