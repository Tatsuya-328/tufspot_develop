<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('manager/users', UserController::class);
});

// adminのみアクセス可能
// Route::group(['middleware' => 'can:admin'], function () {
//     Route::resource('manager/users', 'UserController')->except('show');
// });

