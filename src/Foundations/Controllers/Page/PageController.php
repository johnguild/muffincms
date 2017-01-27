<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Page;

// dependencies
use App\Http\Controllers\Module\ModuleController;
use Illuminate\Http\Request;
// models
use App\Models\Page\Page;
use Auth;


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
  public $pagenotfound = 'pages.notfound';

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
    $this->userCheck('create');
    $templates = \File::allFiles(resource_path('views/pages'));
    foreach ($templates as $key => $value) {
      $templates[$key] = str_replace(array('.blade.php','views/pages/'), '', strstr((string)$value, 'views/pages/'));
    }
    $to_remove = array('create','edit','admin','notfound');
    $templates = array_diff($templates, $to_remove);

    return view('pages.create', compact('templates'));
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
      return view($this->pagenotfound);
    }

    $modules = ModuleController::getContents($mypage->name);

    $mypage->name = substr($mypage->name, 0, 1) === '/' ? substr($mypage->name, 1):$mypage->name;

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
  public function destroy($id)
  {
    $this->userCheck('delete');
    $page = Page::find($id);
    if(!$page) return redirect('/admin/pages');

    $page->delete();

    return redirect('/admin/pages');
  }

  /**
   * Redirects to homepage
   */
  public function home(  ){
    
    $mypage = new Page();
    $mypage->name = config('app.name');
    return view('pages.home', compact('mypage'));
  }


  /**
   * Check for admin role
   * @param int $id
   */
  private function userCheck($a){
    switch ($a) {
      case 'store':
      case 'edit':
      case 'update':
      case 'delete':
        if(!Auth::user()->isAdmin())
          return redirect('/');
        break;
      default:
        return false;
        break;
    }
  }

}
