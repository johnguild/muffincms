<?php

namespace App\Http\Controllers\Page;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Page\PageController as MuffinPageController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
// models
use App\Models\Page\Page;


class PageController extends Controller
{

  use MuffinPageController;

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data, array $rules)
  {   
    return Validator::make($data, $rules);  
  }

  /**
   * Get the appropriate rules for the request method
   * @param string $to
   * @param array $data
   * @return array $data
   */
  private function getRulesTo($to='store', $id=null){
    switch ($to) {
      case 'update':
        return [
          'name'  => 'required|max:255|unique:pages,name,'.$id,
        ];
        break;
      case 'store':
      default:
        return [
          'name'  => 'required|max:255|unique:pages',
        ];
        break;
    }
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $this->userCheck('store');
    $this->validator($request->all(), $this->getRulesTo('store'))->validate();

    $page = new Page();
    $page->name = strtolower($request['name']);
    $page->public = isset($request['public']) ? true:false;
    $page->template = isset($request['template']) ? $request['template']:'index';
    $page->save();

    return redirect('/admin/pages');
  }


  /**
   * Updates an existing resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $this->userCheck('update');
    
    $page = Page::find($request['id']);
    if(!$page) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $page->name = strtolower($request['name']);
    $page->public = isset($request['public']) ? true:false;
    $page->template = isset($request['template']) ? $request['template']:'index';
    $page->save();

    return redirect('/admin/pages');
  }

}
