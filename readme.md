Muffin Content Management System

 -The Package lets you make your laravel project into a CMS 

Version 1.0
Compatibility - Laravel 5.3+


How to install:
	- Create your laravel project
	- Run make:auth to use laravels authenticable user
	- Paste the package in root/packages/johnguild/muffincms
				root
					packages
						johnguild
							muffincms
								src
								composer.json
								readme.md
  - Add the package's service provider in your config/app.php under providers
  			Johnguild\Muffincms\MuffincmsServiceProvider::class,
	- Add the package in your composer.json under autoload
        "psr-4": {
            "App\\": "app/",
            "Johnguild\\Muffincms\\": "packages/johnguild/muffincms/src"
        }
  - Run composer dump-autoload to update the file
	- Run vendor:publish to automagically copy necessary files of the package
	- Edit admin credentials on update user table in migration
	- Run migrate
	- Update your routes folder by copying contents of web.muffin.php to web.php

	Start creating your websites pages contents
	
	Notes: once installed you should NOT delete the packages




