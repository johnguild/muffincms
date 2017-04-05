<?php

namespace Johnguild\Muffincms\traits;

trait TemplateSelector
{

	// Get all existing page templates
	public function existingTemplates($v='pages')
	{
		$templates = \File::allFiles(resource_path("views/vendor/muffincms/$v"));
		foreach ($templates as $key => $value) {
		  	$templates[$key] = str_replace(array('.blade.php',"views/vendor/muffincms/$v/"), '', strstr((string)$value, "views/vendor/muffincms/$v/"));
		}
		$to_remove = array();// add filename to exclude
		$templates = array_diff($templates, $to_remove);
		return $templates;
	}

}
