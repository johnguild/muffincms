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
            __DIR__.'/routes' => base_path('routes'),
            __DIR__.'/config' => base_path('config'),
            __DIR__.'/mvc/controllers' => base_path('app/http/controllers'),
            __DIR__.'/mvc/models' => base_path('app/Models'),
            __DIR__.'/mvc/app' => base_path('app'),
            __DIR__.'/mvc/views' => base_path('resources/views'),
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/assets' => base_path('public'),
        ], 'muffin_cms');


        $this->publishes([
            __DIR__.'/routes' => base_path('routes'),
        ], 'muffin_routes');

        $this->publishes([
            __DIR__.'/config' => base_path('config'),
        ], 'muffin_config');

        $this->publishes([
           __DIR__.'/mvc/controllers' => base_path('app/http/controllers'),
        ], 'muffin_controllers');

        $this->publishes([
            __DIR__.'/mvc/models' => base_path('app/Models'),
            __DIR__.'/mvc/app' => base_path('app'),
        ], 'muffin_models');

        $this->publishes([
           __DIR__.'/mvc/views' => base_path('resources/views'),
        ], 'muffin_views');

        $this->publishes([
           __DIR__.'/migrations' => base_path('database/migrations'),
        ], 'muffin_migrations');

        $this->publishes([
           __DIR__.'/assets' => base_path('public'),
        ], 'muffin_assets');


        $this->publishes([
            __DIR__.'/mvc/app' => base_path('app'),
            __DIR__.'/mvc/controllers/auth' => base_path('app/http/controllers/auth'),
        ], 'muffin_auth');


        // dev
        $this->publishes([
            // __DIR__.'/routes' => base_path('routes'),
            // __DIR__.'/config' => base_path('config'),
            // __DIR__.'/assets' => base_path('public'),
            // __DIR__.'/migrations' => base_path('database/migrations'),
            // __DIR__.'/assets/css/muffincms' => base_path('public/css/muffincms/'),
            // __DIR__.'/assets/js/muffincms' => base_path('public/js/muffincms/'),
            // __DIR__.'/mvc/controllers/link' => base_path('app/http/controllers/link'),
            // __DIR__.'/mvc/controllers/page' => base_path('app/http/controllers/page'),
            // __DIR__.'/mvc/controllers/post' => base_path('app/http/controllers/post'),
            // __DIR__.'/mvc/controllers/admin' => base_path('app/http/controllers/admin'),
            // __DIR__.'/mvc/controllers/text' => base_path('app/http/controllers/text'),
            // __DIR__.'/mvc/views/modules' => base_path('resources/views/modules'),
            // __DIR__.'/mvc/views/layouts/' => base_path('resources/views/layouts/'),
            // __DIR__.'/mvc/views/admins' => base_path('resources/views/admins'),
            // __DIR__.'/mvc/views/pages' => base_path('resources/views/pages'),
            // __DIR__.'/mvc/views/posts' => base_path('resources/views/posts'),
            // __DIR__.'/mvc/views/links' => base_path('resources/views/links'),
            // __DIR__.'/mvc/views/images' => base_path('resources/views/images'),
            // __DIR__.'/mvc/views/texts' => base_path('resources/views/texts'),
            // __DIR__.'/mvc/views/divs' => base_path('resources/views/divs'),
            // __DIR__.'/mvc/views/socials' => base_path('resources/views/socials'),
            // __DIR__.'/mvc/views' => base_path('resources/views'),

        ], 'muffin_dev');

        // $this->loadViewsFrom(__DIR__.'/views', 'muffincms');
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
        require_once __DIR__ . '/Foundations/Helpers/Slugger.php';
        require_once __DIR__ . '/Foundations/Helpers/Setter.php';

    }


}
