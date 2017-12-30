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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
 * 用户面板
 */

// 服务器管理
Route::group(['prefix' => 'server', 'prefix' => 'server'], function () {

    Route::post('create', 'ServerController@create')->name('server.create')->middleware('can:create server');
    Route::get('list/all', 'ServerController@all')->name('server.list.all')->middleware('can:view all servers');
    Route::get('list/my', 'ServerController@my')->name('server.list.my');


});


/**
 * 管理中心
 */
Route::group(['middleware' => 'can:enter the backstage', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('overview', 'OverviewController@index')->name('admin.overview');

    // 主机管理
    Route::group(['prefix' => 'host', 'middleware' => 'can:manage all hosts'], function () {
        Route::get('list', 'HostController@list')->name('admin.host.list');
        Route::post('store/{server?}', 'HostController@store')->name('admin.host.store');
        Route::post('delete/{host}', 'HostController@delete')->name('admin.host.delete');
    });

    Route::group(['prefix' => 'setting', 'middleware' => 'can:manage website settings'], function(){
        Route::get('/', 'SettingController@show')->name('admin.setting.show');
        Route::post('/store', "SettingController@store")->name('admin.setting.store');
    });
});
