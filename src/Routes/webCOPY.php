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


Auth::routes();

Route::get('/', 'Page\PageController@home');
Route::get('/home', 'Page\PageController@home');
Route::get('/package', 'TestController@index');

// text
Route::get('/text/edit/{id}', 'Text\TextController@edit')->middleware('auth');
Route::post('/text/update', 'Text\TextController@update')->middleware('auth');

// should the last route
Route::get('/{page}', 'Page\PageController@show');
