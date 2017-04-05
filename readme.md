Muffin Content Management System

 -The Package lets you make your laravel project into a CMS 

Version 1.0

Compatibility - Laravel 5.3+

Includes

			- TinyMCE 4

			- Font Awesome 4.7.0

			- Sweetalert

How to install:

			- Create your laravel project.

			- Run make:auth to use laravels authenticable user

			- Install and Integrate https://github.com/UniSharp/laravel-filemanager

					tutorials : https://www.youtube.com/watch?v=vBzg0Us5MDk

			- Require this package

			- Add the package's service provider in your config/app.php under providers.

						Johnguild\Muffincms\MuffincmsServiceProvider::class,

			- Run php artisan vendor:publish --tag=muffin_config

			- Run php artisan vendor:publish --tag=muffin_views

			- Run php artisan vendor:publish --tag=muffin_public

			- Run php artisan vendor:publish --tag=muffin_admin --force

			- Run php artisan vendor:publish --tag=muffin_auth --force

			- Run php artisan vendor:publish --tag=muffin_route --force

			- Edit admin credentials create_website_admin migration

			- Run migrate


Start creating your websites pages contents






