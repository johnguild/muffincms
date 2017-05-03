<?php

Auth::routes();

// homepage
Route::get('/', '\Johnguild\Muffincms\MVC\Controllers\PageController@show');
// should the last route
Route::get('/{page}', '\Johnguild\Muffincms\MVC\Controllers\PageController@show');

// lets handle httpRequestNotfound
Route::get('/{wildcard}', '\Johnguild\Muffincms\MVC\Controllers\PageController@notfound')->where(['wildcard' => '.*']);