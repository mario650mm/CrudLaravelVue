<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'],function (){
    Route::get('/users/list','UsersController@index');
    Route::get('/users/create','UsersController@create');
    Route::post('/users/create','UsersController@store');
    Route::get('/users/edit/{id}','UsersController@edit');
    Route::put('/users/update/{id}','UsersController@update');
    Route::delete('/users/delete/{id}','UsersController@destroy');
    Route::get('/users/showImagen/{filename}','UsersController@getImage');
});
