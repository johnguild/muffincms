<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Module;

// dependencies
// models


trait ModuleController
{

	/**
	 * List of all available modules except Page
	 * key = module name
	 * value = applications directory 
	 */
	protected static $available = [
			'\Text'=>'\App\Models\Text',
			'\Link'=>'\App\Models\Link'
		];


	/**
	 * Retrieve's all modules and their contents
	 * @return array
	 */
	public static function getContents( $url = null ){
		
		$modules = [];

		foreach (self::$available as $key => $mod) {
			$model = $mod . $key;
			if($url)
				$modules[stripslashes($key)] = $model::where('url', $url)->orderBy('rank','desc')->get();
			else
				$modules[stripslashes($key)] = $model::orderBy('rank','desc')->get();
		}

		return $modules;
	}
}
