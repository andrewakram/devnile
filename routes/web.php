<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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
Route::get('cache', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'success';
});

Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers'
], function () {

    Route::group(['namespace' => 'Admin', 'as' => 'admin'], function () {
        Route::get('login', 'AuthController@login_view')->name('login-view');
        Route::post('login', 'AuthController@login')->name('.login');
        Route::get('logout', 'AuthController@logout')->name('.logout');

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('home', 'HomeController@index')->name('.home');
        });
        Route::group(['middleware' => 'auth:admin'], function () {

            Route::group(['prefix' => 'supervisors', 'as' => '.supervisors'], function () {
                Route::get('/', 'SupervisorController@index');
                Route::get('getData', 'SupervisorController@getData')->name('.datatable');
                Route::get('/create', 'SupervisorController@create')->name('.create');
                Route::post('/store', 'SupervisorController@store')->name('.store');
                Route::get('/edit/{id}', 'SupervisorController@edit')->name('.edit');
                Route::post('/update', 'SupervisorController@update')->name('.update');
                Route::get('/show/{id}', 'SupervisorController@show')->name('.show');
                Route::post('/delete', 'SupervisorController@delete')->name('.delete');
                Route::post('/delete-multi', 'SupervisorController@deleteMulti')->name('.deleteMulti');
            });
            Route::group(['prefix' => 'categories', 'as' => '.categories'], function () {
                Route::get('/', 'SupervisorController@index');
                Route::get('getData', 'SupervisorController@getData')->name('.datatable');
            });
            Route::group(['prefix' => 'products', 'as' => '.products'], function () {
                Route::get('/', 'SupervisorController@index');
                Route::get('getData', 'SupervisorController@getData')->name('.datatable');
            });

        });
    });

});

Route::group([
    'prefix' => 'supervisor',
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::group(['namespace' => 'Supervisor', 'as' => 'supervisor'], function () {
        Route::get('login', 'AuthController@login_view')->name('login-view');
        Route::post('login', 'AuthController@login')->name('.login');
        Route::get('logout', 'AuthController@logout')->name('.logout');

        Route::group(['middleware' => 'auth:supervisor'], function () {
            Route::get('home', 'HomeController@index')->name('.home');
        });

        Route::group(['middleware' => 'auth:supervisor'], function () {

            Route::group(['prefix' => 'categories', 'as' => '.categories'], function () {
                Route::get('/', 'CategoryController@index');
                Route::get('getData', 'CategoryController@getData')->name('.datatable');
                Route::get('/create', 'CategoryController@create')->name('.create');
                Route::post('/store', 'CategoryController@store')->name('.store');
                Route::get('/edit/{id}', 'CategoryController@edit')->name('.edit');
                Route::post('/update', 'CategoryController@update')->name('.update');
                Route::get('/show/{id}', 'CategoryController@show')->name('.show');
                Route::post('/delete', 'CategoryController@delete')->name('.delete');
                Route::post('/delete-multi', 'CategoryController@deleteMulti')->name('.deleteMulti');
            });

            Route::group(['prefix' => 'products', 'as' => '.products'], function () {
                Route::get('/', 'ProductController@index');
                Route::get('getData', 'ProductController@getData')->name('.datatable');
                Route::get('/create', 'ProductController@create')->name('.create');
                Route::post('/store', 'ProductController@store')->name('.store');
                Route::get('/edit/{id}', 'ProductController@edit')->name('.edit');
                Route::post('/update', 'ProductController@update')->name('.update');
                Route::get('/show/{id}', 'ProductController@show')->name('.show');
                Route::post('/delete', 'ProductController@delete')->name('.delete');
                Route::post('/delete-image', 'ProductController@deleteImage')->name('.image.delete');
                Route::post('/delete-multi', 'ProductController@deleteMulti')->name('.deleteMulti');
            });

        });
    });

});
