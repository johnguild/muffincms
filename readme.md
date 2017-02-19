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

			
			- Paste the package in root/packages/johnguild/muffincms

			- Add the package's service provider in your config/app.php under providers.

						Johnguild\Muffincms\MuffincmsServiceProvider::class,

			- Add the package in your composer.json under autoload.

			      "psr-4": {

			          "App\\": "app/",

			          "Johnguild\\Muffincms\\": "packages/johnguild/muffincms/src"

			      }

			- Run composer dump-autoload to update the file.

			- Run art vendor:publish --tag=muffin_cms

			- Run art vendor:publish --tag=muffin_auth --force

			- Run art vendor:publish --tag=muffin_routes --force

			- Edit admin credentials on update user table in migration

			- Run migrate



Start creating your websites pages contents


Notes: once installed you should NOT delete the packages




