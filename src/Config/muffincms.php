<?php

return [


    // Middlewares which should be applied to all package routes.
    'middlewares' => ['web','auth'],

    // The url to this package. Change it if necessary.
    'prefix' => 'admin',


    'maintenance' =>  env('MUFFIN_MAINTENANCE', false),

    'registration' =>  env('MUFFIN_REGISTRATION', false),

   
];
