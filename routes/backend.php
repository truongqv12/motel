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

    Route::get('/file-manager', 'Backend\DashboardController@fileManager')->name('admin.file');

    Route::resource('administration', 'Backend\AdminController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('users', 'Backend\UserController');
    Route::resource('category', 'Backend\CategoryController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('posts', 'Backend\PostController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('motelroom', 'Backend\MotelController', ['only' => ['index', 'destroy']]);
    Route::group([
        'prefix' => 'motelroom',
    ], function () {
        Route::get('/active/{id}', 'Backend\MotelController@active')->name('motelroom.active');
        Route::get('/unactive/{id}', 'Backend\MotelController@unactive')->name('motelroom.unactive');
        Route::get('/report', 'Backend\MotelController@report')->name('motelroom.report');
    });
});
