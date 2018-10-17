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

//Route::get('/home', 'HomeController@index')->name('home');
//
//Route::get('/', 'HomeController@index');
//Route::post('/', 'HomeController@index');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'GalleryApi@landing')->name('home');

Route::get('/', 'GalleryApi@landing');
Route::post('/', 'GalleryApi@landing');

Route::group(['middleware' => 'web', 'prefix' => '/gallery'], function () {
    Route::get('item/show/{id}', 'GalleryApi@apiShow');
    Route::get('landing', 'GalleryApi@landing');

    Route::get('register', 'GalleryApi@register')->name('register');
    Route::post('register', 'GalleryApi@registerForm');
});

//api

Route::group(['middleware' => 'web', 'prefix' => '/api/v1/gallery'], function () {
    Route::post('like/{id}', 'GalleryApi@apiLike');
    Route::post('store', 'GalleryApi@apiStore');
    Route::get('index', 'GalleryApi@apiIndex')->name('gallery.index');
    Route::get('show/{id}', 'GalleryApi@apiShow');
    Route::get('winners', 'GalleryApi@apiWinners');
});

Route::group(['middleware' => 'web', 'prefix' => '/gallery'], function () {
    Route::get('index', 'GalleryApi@index')->name('galleryindex');
    Route::get('/', 'GalleryApi@index')->name('galleryindex');

    Route::get('/participate', 'GalleryApi@participate')->name('participate');
    Route::get('/winners', 'GalleryApi@winners')->name('winners');
});

//admin

/*
Route::get('admin/insert', 'UserController::@index');
Route::post('store', 'UserController::@store');
*/

Route::group(['middleware' => 'admin','namespace' => 'Admin', 'prefix' => 'admin'], function() {
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
    Route::get('login', 'Auth\LoginController@login');

    Route::get('gallery', 'GalleryController@index');
    Route::get('gallery/index', 'GalleryController@index');
    Route::post('gallery/update', 'GalleryController@update');
    Route::post('gallery/updateToggle', 'GalleryController@updateToggle');
    Route::get('gallery/delete/{id}', 'GalleryController@destroy');
});