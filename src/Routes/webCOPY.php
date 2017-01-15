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

// text
Route::get('/text/edit/{id}', 'Text\TextController@edit')->middleware('auth');
Route::get('/text/create/url/{myurl}/location/{myloc}', 'Text\TextController@create')->middleware('auth');
Route::get('/text/delete/{id}', 'Text\TextController@destroy')->middleware('auth');
Route::post('/text/store', 'Text\TextController@store')->middleware('auth');
Route::post('/text/update', 'Text\TextController@update')->middleware('auth');
Route::get('/text/{section}', 'Text\TextController@notfound')->where(['section' => '.*']);

// should the last route
Route::get('/{page}', 'Page\PageController@show');
