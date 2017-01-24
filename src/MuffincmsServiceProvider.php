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
            __DIR__.'/models' => base_path('app/Models'),
            __DIR__.'/app' => base_path('app/'),
            __DIR__.'/views' => base_path('resources/views/'),
            __DIR__.'/migrations' => base_path('database/migrations/'),
            __DIR__.'/assets' => base_path('public/'),
        ], 'muffin_cms');


        $this->publishes([
            __DIR__.'/routes' => base_path('routes/'),
        ], 'muffin_routes');

        $this->publishes([
           __DIR__.'/controllers' => base_path('app/http/controllers'),
        ], 'muffin_controllers');

        $this->publishes([
            __DIR__.'/models' => base_path('app/Models'),
            __DIR__.'/app' => base_path('app/'),
        ], 'muffin_models');

        $this->publishes([
           __DIR__.'/views' => base_path('resources/views/'),
        ], 'muffin_views');

        $this->publishes([
           __DIR__.'/migrations' => base_path('database/migrations/'),
        ], 'muffin_migrations');

        $this->publishes([
           __DIR__.'/assets' => base_path('public/'),
        ], 'muffin_assets');
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
        // include __DIR__.'/Routes/web.php';
        // $this->app->make('Johnguild\Muffincms\TestController');
    }
}
