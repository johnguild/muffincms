<?php

namespace Johnguild\Muffincms\Traits;

trait HrefBuilder
{

	public function href($type='all')
	{

		$url = url($this->href);
		switch (strtolower($type)) {
			case 'show':
			case 'update':
			case 'delete':
				$url .= '/'.$this->id;
				break;
			case 'create':
				$url .= '/create';
				break;
			case 'store':
				$url .= '/store';
				break;
			case 'edit':
				$url .= '/'.$this->id.'/edit';
				break;
			case 'all':
			default:
				break;
		}
		return $url;
	}

}