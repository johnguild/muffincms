<?php

namespace Johnguild\Muffincms\Traits;

trait HrefBuilder
{

	public function href($type='all', $prefix='', $postfix='')
	{

		$url = url('');
		if(!empty($prefix)){
			if(is_array($prefix))
				$url .= implode('/', $prefix);
			else
				$url .= '/'.$prefix;
		}
		$url .= '/'.$this->href;

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

		if(!empty($postfix)){
			if(is_array($postfix))
				$url .= implode('/', $postfix);
			else
				$url .= '/'.$postfix;
		}

		return $url;
	}

}