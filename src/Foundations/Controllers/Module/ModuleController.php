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
			'\Link'=>'\App\Models\Link',
			'\Div'=>'\App\Models\Div',
			'\Image'=>'\App\Models\Image',
		];

	protected static $hierarchy = [
			'\Text'=>['rank','desc'],
			'\Link'=>['rank','asc'],
			'\Div'=>['rank','asc'],
			'\Image'=>['rank','desc'],
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
				$modules[stripslashes($key)] = 
					$model::where('url', $url)
						->orWhere('global', true)
						->orderBy(self::$hierarchy[$key][0], self::$hierarchy[$key][1])
						->get();
			else
				$modules[stripslashes($key)] = 
					$model::orderBy('rank','desc')
						->get();
		}

		return $modules;
	}

	public static function getDeletableModules(){
		$modules = [];
		foreach (self::$available as $key => $mod) {
			$modules[] =  $mod . $key;
		}	
		return $modules;
	}

	/**
	* Get all existing pages tempaltes
	* @return array
	*/
	public static function existingTemplates($v='pages')
	{
		$templates = \File::allFiles(resource_path("views/$v"));
		foreach ($templates as $key => $value) {
		  $templates[$key] = str_replace(array('.blade.php',"views/$v/"), '', strstr((string)$value, "views/$v/"));
		}
		$to_remove = array('create','edit','admin','notfound');
		$templates = array_diff($templates, $to_remove);
		return $templates;
	}
}
