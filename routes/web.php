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
    return view('home');
});

Route::get('shoes', 'ShoesController@index');
Route::get('shoes/create', 'ShoesController@create');
Route::get('shoes/{id}/edit', 'ShoesController@edit');
Route::post('shoes', 'ShoesController@store');
Route::put('shoes/{id}/{rev}', 'ShoesController@update');
Route::delete('shoes/{id}/{rev}', 'ShoesController@destroy');
