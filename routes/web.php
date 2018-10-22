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

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@landing')->name('home');
Route::get('/', 'HomeController@landing');
Route::post('/', 'HomeController@landing');

Route::group(['middleware' => 'web', 'prefix' => '/gallery'], function () {
    Route::get('index', 'HomeController@index')->name('galleryindex');
    Route::get('/', 'HomeController@index')->name('galleryindex');
    Route::get('/participate', 'HomeController@participate')->name('participate');
    Route::get('/winners', 'HomeController@winners')->name('winners');
    Route::post('participate', 'HomeController@registerForm');
});

Route::group(['middleware' => 'web', 'prefix' => '/api/v1/gallery'], function () {
    Route::post('store', 'GalleryApi@apiStore');
    Route::post('like/{id}', 'GalleryApi@apiLike');
});


//admin

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('user', 'UserController@index');
    Route::get('user/index', 'UserController@index');
    Route::get('user/insert', 'UserController@insert');
    Route::get('user/update/{id}', 'UserController@edit');
    Route::post('user/store', 'UserController@store');
    Route::patch('user/edit/{id}', 'UserController@update');
    Route::get('user/delete/{id}', 'UserController@destroy');

    Route::get('cycle', 'CyclesController@index');
    Route::get('cycle/index', 'CyclesController@index');
    Route::get('cycle/insert', 'CyclesController@insert');
    Route::get('cycle/update/{id}', 'CyclesController@edit');
    Route::post('cycle/store', 'CyclesController@store');
    Route::patch('cycle/edit/{id}', 'CyclesController@update');
    Route::get('cycle/delete/{id}', 'CyclesController@destroy');

    Route::get('', 'IndexController@index');
    Route::get('index', 'IndexController@index');

    Route::get('gallery', 'GalleryController@index');
    Route::get('gallery/index', 'GalleryController@index');
    Route::post('gallery/update', 'GalleryController@update');
    Route::post('gallery/updateToggle', 'GalleryController@updateToggle');
    Route::get('gallery/delete/{id}', 'GalleryController@destroy');
});


//share route

Route::group(['middleware' => 'web', 'prefix' => '/gallery/share', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/{modelId}', 'GalleryShareController@index');
});
