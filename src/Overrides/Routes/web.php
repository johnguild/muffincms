<?php

Auth::routes();

// homepage
Route::get('/', '\Johnguild\Muffincms\MVC\controllers\PageController@show');
// should the last route
Route::get('/{page}', '\Johnguild\Muffincms\MVC\controllers\PageController@show');

// lets handle httpRequestNotfound
Route::get('/{wildcard}', '\Johnguild\Muffincms\MVC\controllers\PageController@notfound')->where(['wildcard' => '.*']);