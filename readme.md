# Muffin Content Management System
[![Latest Stable Version](https://poser.pugx.org/johnguild/muffincms/v/stable)](https://packagist.org/packages/johnguild/muffincms)
[![Total Downloads](https://poser.pugx.org/johnguild/muffincms/downloads)](https://packagist.org/packages/johnguild/muffincms)
[![License](https://poser.pugx.org/johnguild/muffincms/license)](https://packagist.org/packages/johnguild/muffincms)

## Requires
 * [Unisharp/Larvelfilemanaer](https://github.com/UniSharp/laravel-filemanager)

## Includes
 * TinyMCE 4
 * Font Awesome 4.7.0
 * [Sweetalert](https://github.com/t4t5/sweetalert)

## Installation
Create your laravel project as you normally do and setup .env

We will be using the laravel authenticable user so run

  ```bash
  php artisan make:auth
  ```

Install and Integrate [Unisharp/Laravelfilemanager](https://github.com/UniSharp/laravel-filemanager)

Install Package :

  ```bash
  composer require johnguild/muffincms
  ```

Edit config/app.php :

 Add Service Provider

  ```php
  Johnguild\Muffincms\MuffincmsServiceProvider::class,
  ```

Publish the package's config, assets, and resources :

  ```bash
  php artisan vendor:publish --tag=muffin_config
  php artisan vendor:publish --tag=muffin_views
  php artisan vendor:publish --tag=muffin_public
  php artisan vendor:publish --tag=muffin_admin --force
  php artisan vendor:publish --tag=muffin_auth --force
  php artisan vendor:publish --tag=muffin_route --force
  ```

Migrate tables :

 Make sure to edit the admin credential in database/migrations/muffin_create_website_admin

 ```php
 php artisan migrate
 ```






