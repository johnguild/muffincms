<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Page;

// dependencies
use App\Http\Controllers\Module\ModuleController;
use Illuminate\Http\Request;
// models
use App\Models\Page\Page;



trait PageController
{
  /**
   * Still thinking where to use these
   * probably by excluding them in the route?
   */
  protected $exceptions = [
          'products',
          'category'
      ];

  /**
   * Page not found view name
   */    
  public $notfoundview = 'notfound';

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($page)
  {

    $mypage = Page::where('name', $page)->first();

    if(!$mypage){
      // DEV -> we want the admin to view a blank page with an option to add this page
      return view('pages.'.$this->notfoundview);
    }

    $modules = ModuleController::getContents();

    return view('pages.'.$mypage->template, compact('mypage','modules'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($page)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $page)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($page)
  {
      //
  }

}
