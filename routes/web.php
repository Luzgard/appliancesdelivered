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

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('favorite/{product}', [
        'uses' => 'ProductController@favorite',
        'as' => 'favorite'
    ]);

    Route::get('favorites', [
        'as' => 'favorites',
        'uses' => 'ProductController@favorites'
    ]);

    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'UserController@edit'
    ]);

    Route::put('profile', [
        'as' => 'profile',
        'uses' => 'UserController@update'
    ]);
});

Auth::routes();

// Route::get('/home', 'HomeController@index');
