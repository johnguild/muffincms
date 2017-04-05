<?php

namespace Johnguild\Muffincms\MVC\Controllers;

use Johnguild\Muffincms\Traits\ModelSelector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;


class CreateController extends Controller
{
    
    use ModelSelector;
    
    // prefix for forms view
    protected $form = 'create_';

    // display module create form
    public function showCreateForm(Request $request, $module)
    {    

    	if($module == 'page')
    		return redirect('admin/pages#create-page');

        $url = $request['url'];
        $location = $request['location'];
        
        return view('muffincms::forms.'.$this->form.$module,
                compact('url', 'location'));
    }


    // create a new instance for module
	public function storeInstance(Request $request, $module)
	{    

		if($module == 'page')
			$request['name'] = makeSlug($request['name']);

		$this->validator($request->all(), $this->rules($module))->validate();

		$model = $this->getModel($module);
		if(!$model)
        	return redirect('/');

		$i = new $model();
		$i->addNew($request->all());

		flash('success', 'New '.ucfirst($module).' has been created');

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
	protected function rules($module)
	{
		$generic = [
					'url'       => 'required|max:255',
			        'location'  => 'required|max:255'
			        ];

		switch ($module) {
			case 'page':
				return ['name'  => 'required|max:255|unique:pages',
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
