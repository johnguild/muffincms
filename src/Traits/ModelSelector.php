<?php

namespace Johnguild\Muffincms\traits;

trait ModelSelector
{
	
	// all available modules/models
	protected $models = [
			'text' => 'Johnguild\Muffincms\MVC\models\Text',
			'link' => 'Johnguild\Muffincms\MVC\models\Link',
			'image' => 'Johnguild\Muffincms\MVC\models\Image',
			'page' => 'Johnguild\Muffincms\MVC\models\Page',
			'viewer' => 'Johnguild\Muffincms\MVC\models\Viewer'
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