<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\PostController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();
Route::get('/logout', [LoginController::class, 'logout']);
