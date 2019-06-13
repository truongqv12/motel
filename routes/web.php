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

Route::get('/', 'HomeController@index')->name('index');

Route::get('/loai-phong/{rewrite}', 'MotelRoomController@list')->name('motel.list');

Route::get('/{cat_id}/{rewrite}', 'MotelRoomController@detail')->where(['cat_id' => '[0-9]+'])->name('motel.detail');

Route::get('/tim-kiem', 'MotelRoomController@search')->name('motel.search');

Route::get('/ban-do', 'MapController@index')->name('map.index');


Route::group([
    'prefix' => 'ajax',
], function () {
    Route::get('/load-district', 'Ajax\CityAjaxController@getDistrictByCity')->name('ajax.district');
    Route::get('/load-ward', 'Ajax\CityAjaxController@getWardByDistrict')->name('ajax.ward');

    Route::group([
        'prefix' => 'dropzone',
    ], function () {
//        Route::get('/upload','DropzoneUploadController@fileCreate');
        Route::post('/upload/store', 'DropzoneUploadController@fileStore')->name('ajax.upload.store');
        Route::post('/delete', 'DropzoneUploadController@fileDestroy')->name('ajax.upload.delete');
    });

});

Route::get('/login', 'HomeController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/signup', 'HomeController@signupForm')->name('signup');
Route::post('/signup', 'Auth\RegisterController@register')->name('signup.post');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/trang-ca-nhan', 'ProfileController@index')->name('profile');
    Route::get('/tin-da-dang', 'ProfileController@motelPost')->name('profile.motel_post');
    Route::get('/dang-tin-mien-phi', 'MotelRoomController@showFormPostMotel')->name('motel_post.view');
    Route::post('/dang-tin-mien-phi', 'MotelRoomController@postMotel')->name('motel_post.post');

});
