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
});