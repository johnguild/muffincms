<?php

namespace Johnguild\Muffincms\MVC\Controllers;

use Johnguild\Muffincms\Traits\TemplateSelector;
use Johnguild\Muffincms\Traits\ModelSelector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;


class UpdateController extends Controller
{

    use ModelSelector, TemplateSelector;
    
    // prefix for forms view
    protected $form = 'edit_';

    // display module create form
    public function showEditForm(Request $request, $module, $id)
    {    
        
        $model = $this->getModel($module);
        if(!$model)
        	return redirect('/');

        $mod = $model::find($id);
        
        if(!$mod){
        	flash('danger', ucfirst($module).' does not exists');
        	return redirect('/'); 
        }

        $templates = '';
        if($module == 'page')
        	$templates = $this->existingTemplates();
        
        return view('muffincms::forms.'.$this->form.$module,
                compact('url', 'location', 'mod', 'templates'));
    }


    // create a new instance for module
	public function updateInstance(Request $request, $module)
	{    

		if($module == 'page')
			$request['name'] = makeSlug($request['name']);

		$this->validator($request->all(), $this->rules($module, $request['id']))->validate();

		$model = $this->getModel($module);
		if(!$model)
        	return redirect('/');

		$i = $model::find($request['id']);
		if(!$i){
			flash('danger', ucfirst($module).' does not exists');
			return redirect('/');
		}

		$i->updateExisting($request->all());

		flash('success', ucfirst($module).' has been updated');

		if($module == 'page')
			return redirect('admin/pages');

		return redirect($i->url);
	}

    // validator
	protected function validator(array $data, array $rules)
	{   
		return Validator::make($data, $rules);  
	}

	// rules to use for validation
	protected function rules($module, $id)
	{
		$generic = [
					'url'       => 'required|max:255',
			        'location'  => 'required|max:255'
			    ];

		switch ($module) {
			case 'page':
				return ['name'  => 'required|max:255|unique:pages,name,'.$id,
          				'desc'  => 'required|max:5000'];
				break;
			case 'image':
				return array_merge($generic, []);
				break;
			case 'link':
				return array_merge($generic, [
						'title'     => 'required|max:255',
			        	'address'   => 'required|max:255']);
				break;
			case 'text':
			default:
				return array_merge($generic, [
						'content'   => 'required|max:10000']);
				break;
		}
	}



}
