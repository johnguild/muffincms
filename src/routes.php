<?php
$middleware = array_merge(\Config::get('muffincms.middlewares', ['web','auth']), [
        '\Johnguild\Muffincms\middlewares\SuperAdmin'
    ]);
// $middleware = \Config::get('muffincms.middlewares');
$prefix = \Config::get('muffincms.prefix', 'admin');
$namespace = '\Johnguild\Muffincms\MVC\controllers';

// make sure authenticated
Route::group(compact('middleware', 'prefix',  'namespace'), function () {

  	Route::get('/', 'AdminController@showDashboard');
  	Route::get('pages', 'AdminController@showPages');
  	// Route::get('posts', 'AdminController@showDashboard');
  	Route::get('settings', 'AdminController@showSettings');

    // crud for pages, texts, links, images
  	Route::get('{module}/create', 'CreateController@showCreateForm');
  	Route::post('{module}/store', 'CreateController@storeInstance');
  	Route::get('{module}/{id}/edit', 'UpdateController@showEditForm');
  	Route::post('{module}/update', 'UpdateController@updateInstance');
    Route::post('{module}/delete', 'DeleteController@deleteInstance');

    // settings update
    Route::post('settings', 'AdminController@updateSettings');
});




