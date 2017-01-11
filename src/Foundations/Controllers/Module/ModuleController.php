<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Module;

// dependencies
// models


trait ModuleController
{

	/**
	 * List of all available modules except Page
	 */
	protected static $available = [
			'\Text'=>'\App\Models\Text'
		];


	/**
	 * Retrieve's all modules and their contents
	 * @return array
	 */
	public static function getContents(  ){
		
		$texts = \App\Models\Text\Text::orderBy('rank','desc')->get();

		$modules = [];

		foreach (self::$available as $key => $mod) {
			$model = $mod . $key;
			$modules[stripslashes($key)] = $model::orderBy('rank','desc')->get();
		}

		return $modules;
	}
}
