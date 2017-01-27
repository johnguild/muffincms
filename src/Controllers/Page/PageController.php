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
  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name'      => 'required|max:255|unique:pages',
      ]);
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
    $this->validator($request->all())->validate();

    $page = new Page();
    $page->name = strtolower($request['name']);
    $page->public = isset($request['public']) ? true:false;
    $page->template = isset($request['template']) ? $request['template']:'index';
    $page->save();

    return redirect('/admin/pages');
  }

}
