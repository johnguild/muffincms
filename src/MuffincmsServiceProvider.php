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
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadMigrationsFrom(__DIR__.'/migrations');
        
        $this->loadViewsFrom(__DIR__.'/MVC/views', 'muffincms');

        $this->publishes([
            __DIR__.'/config' => base_path('config'),
        ], 'muffin_config');

        $this->publishes([
           __DIR__.'/overrides/routes' => base_path('routes'),
        ], 'muffin_route');

        $this->publishes([
           __DIR__.'/overrides/migrations' => base_path('database/migrations'),
        ], 'muffin_admin');

        $this->publishes([
            __DIR__.'/overrides/app' => base_path('app'),
            __DIR__.'/overrides/auth' => base_path('app/http/controllers/auth'),
        ], 'muffin_auth');

        $this->publishes([
            __DIR__.'/mvc/views/pages' => base_path('resources/views/vendor/muffincms/pages'),
            __DIR__.'/mvc/views/users' => base_path('resources/views/vendor/muffincms/users'),
        ], 'muffin_views');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/muffincms'),
        ], 'muffin_public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // include __DIR__.'/Routes/web.php';
        // $this->app->make('Johnguild\Muffincms\TestController');
        require_once __DIR__ . '/Helpers/Slugger.php';
        require_once __DIR__ . '/Helpers/Setter.php';
        require_once __DIR__ . '/Helpers/Flasher.php';
    }


}
