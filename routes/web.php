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
 * 管理中心
 */
Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('overview', 'OverviewController@index')->name('admin.overview');

    // 主机管理
    Route::group(['prefix' => 'host'], function () {
        Route::get('list', 'HostController@list')->name('admin.host.list');
        Route::post('store/{server?}', 'HostController@store')->name('admin.host.store');
    });
});
