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
Route::get('/maintenance', 'Page\PageController@maintenance');

// admin
Route::get('/admin', 'Admin\AdminController@dashboard')->middleware('auth');
Route::get('/dashboard', 'Admin\AdminController@dashboard')->middleware('auth');
Route::get('/admin/posts', 'Admin\AdminController@posts')->middleware('auth');
Route::get('/admin/pages', 'Admin\AdminController@pages')->middleware('auth');
Route::get('/admin/settings', 'Admin\AdminController@settings')->middleware('auth');
Route::post('/admin/update', 'Admin\AdminController@update')->middleware('auth');

// divs
Route::get('/div/edit/{id}', 'Div\DivController@edit')->middleware('auth');
Route::get('/div/create/url/{myurl}/location/{myloc}', 'Div\DivController@create')->middleware('auth');
Route::get('/div/delete/{id}', 'Div\DivController@destroy')->middleware('auth');
Route::post('/div/store', 'Div\DivController@store')->middleware('auth');
Route::post('/div/update', 'Div\DivController@update')->middleware('auth');
Route::get('/div/{wildcard}', 'Div\DivController@notfound')->where(['wildcard' => '.*']);

// pages
Route::get('/page/edit/{id}', 'Page\PageController@edit')->middleware('auth');
Route::get('/page/create/', 'Page\PageController@create')->middleware('auth');
Route::post('/page/store', 'Page\PageController@store')->middleware('auth');
Route::post('/page/update', 'Page\PageController@update')->middleware('auth');
Route::get('/page/delete/{id}', 'Page\PageController@destroy')->middleware('auth');
Route::get('/page/{wildcard}', 'Page\PageController@notfound')->where(['wildcard' => '.*']);

// posts
Route::get('/post/edit/{id}', 'Post\PostController@edit')->middleware('auth');
Route::get('/post/create/', 'Post\PostController@create')->middleware('auth');
Route::post('/post/store', 'Post\PostController@store')->middleware('auth');
Route::post('/post/update', 'Post\PostController@update')->middleware('auth');
Route::get('/post/delete/{id}', 'Post\PostController@destroy')->middleware('auth');
Route::get('/post/{wildcard}', 'Post\PostController@notfound')->where(['wildcard' => '.*']);

// text
Route::get('/text/edit/{id}', 'Text\TextController@edit')->middleware('auth');
Route::get('/text/create/url/{myurl}/location/{myloc}', 'Text\TextController@create')->middleware('auth');
Route::get('/text/delete/{id}', 'Text\TextController@destroy')->middleware('auth');
Route::post('/text/store', 'Text\TextController@store')->middleware('auth');
Route::post('/text/update', 'Text\TextController@update')->middleware('auth');
Route::get('/text/{wildcard}', 'Text\TextController@notfound')->where(['wildcard' => '.*']);

// links
Route::get('/link/edit/{id}', 'Link\LinkController@edit')->middleware('auth');
Route::get('/link/create/url/{myurl}/location/{myloc}', 'Link\LinkController@create')->middleware('auth');
Route::get('/link/delete/{id}', 'Link\LinkController@destroy')->middleware('auth');
Route::post('/link/store', 'Link\LinkController@store')->middleware('auth');
Route::post('/link/update', 'Link\LinkController@update')->middleware('auth');
Route::get('/link/{wildcard}', 'Link\LinkController@notfound')->where(['wildcard' => '.*']);

// images
Route::get('/image/edit/{id}', 'Image\ImageController@edit')->middleware('auth');
Route::get('/image/create/url/{myurl}/location/{myloc}', 'Image\ImageController@create')->middleware('auth');
Route::get('/image/delete/{id}', 'Image\ImageController@destroy')->middleware('auth');
Route::post('/image/store', 'Image\ImageController@store')->middleware('auth');
Route::post('/image/update', 'Image\ImageController@update')->middleware('auth');
Route::get('/image/{wildcard}', 'Image\ImageController@notfound')->where(['wildcard' => '.*']);

// should the last route
Route::get('/{page}', 'Page\PageController@show');

// check posts first
Route::get('/{slug}', 'Post\PostController@show');


