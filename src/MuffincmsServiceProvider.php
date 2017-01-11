<?php

namespace Johnguild\Muffincms;

use Illuminate\Support\ServiceProvider;

class MuffincmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // copy all necessary files to application
        $this->publishes([
            __DIR__.'/routes' => base_path('routes/'),
            __DIR__.'/controllers' => base_path('app/http/controllers'),
            __DIR__.'/models' => base_path('app/models'),
            __DIR__.'/views' => base_path('resources/views/'),
            __DIR__.'/migrations' => base_path('database/migrations/'),
        ]);
        // $this->loadViewsFrom(__DIR__.'/views', 'muffincms');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // include __DIR__.'/web.php';
        // $this->app->make('Johnguild\Muffincms\TestController');
    }
}
