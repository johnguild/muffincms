<?php

namespace Johnguild\Muffincms\MVC\Controllers;

use Johnguild\Muffincms\Traits\ModelSelector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DeleteController extends Controller
{

    use ModelSelector;
    

    // delete instance for module
	public function deleteInstance(Request $request, $module)
	{    

		$model = $this->getModel($module);
		if(!$model)
        	return redirect('/');

		$i = $model::find($request['id']);
		if(!$i){
			flash('danger', ucfirst($module).' does not exists');
			return redirect('/');
		}

		$model::destroy($request['id']);

		flash('success', 'A '.ucfirst($module).' has been removed');

		if($module == 'page')
			return redirect('/admin/pages');
		
		return redirect($i->url);
	}

}
