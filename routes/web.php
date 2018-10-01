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
    Route::get('item/hvala', 'GalleryApi@returnUploadedImage');
    Route::get('landing', 'GalleryApi@landing');

    Route::get('register', 'GalleryApi@register')->name('register');
    Route::post('register', 'GalleryApi@registerForm');
});

//api

Route::group(['middleware' => 'web', 'prefix' => '/api/v1/gallery'], function () {
    Route::post('like/{id}', 'GalleryApi@apiLike');
    Route::post('store', 'GalleryApi@apiStore');
    Route::get('index', 'GalleryApi@apiIndex')->name('gallery.index');
    Route::get('index/paginate', 'GalleryApi@apiIndexPaginate');
    Route::get('show/{id}', 'GalleryApi@apiShow');
    Route::get('winners', 'GalleryApi@apiWinners');

    Route::get('active', 'GalleryApi@apiIsActive');
});

Route::group(['middleware' => 'web', 'prefix' => '/gallery'], function () {
    Route::get('show/{modelId}', 'GalleryApi@indexWithModalShown');
    Route::get('index', 'GalleryApi@index')->name('galleryindex');
    Route::get('/', 'GalleryApi@index')->name('galleryindex');

    Route::get('/participate', 'GalleryApi@participate')->name('participate');
    Route::get('/winners', 'GalleryApi@winners')->name('winners');//ToDo winners???
});

