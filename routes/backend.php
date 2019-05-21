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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Backend\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Backend\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Backend\Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/', 'Backend\DashboardController@index')->name('admin');

    Route::resource('administration', 'Backend\AdminController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('users', 'Backend\UserController');
    Route::resource('category', 'Backend\CategoryController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('posts', 'Backend\PostController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('author', 'Backend\AuthorController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('publishing_house', 'Backend\PublishingHouseController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('motelroom', 'Backend\MotelController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('banner', 'Backend\BannerController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('order', 'Backend\OrderController', ['only' => ['index', 'edit', 'update']]);

});
