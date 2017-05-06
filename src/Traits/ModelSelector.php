<?php

namespace Johnguild\Muffincms\Traits;

trait ModelSelector
{
	
	// all available modules/models
	protected $models = [
			'text' => 'Johnguild\Muffincms\MVC\Models\Text',
			'link' => 'Johnguild\Muffincms\MVC\Models\Link',
			'image' => 'Johnguild\Muffincms\MVC\Models\Image',
			'page' => 'Johnguild\Muffincms\MVC\Models\Page',
			'viewer' => 'Johnguild\Muffincms\MVC\Models\Viewer'
		];

	protected $notModules = [
			'page', 'viewer'
		];

	// retrieve the model with complete path
	public function getModel($module)
	{
		if(!array_key_exists($module, $this->models))
			return false;
		
		return $this->models[$module];
	}

	public function getModules()
	{
		$modules = $this->models;
		foreach ($this->notModules as $model) {
			unset($modules[$model]);
		}
		return $modules;
	}

}