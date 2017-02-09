<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Page;

// dependencies
use App\Http\Controllers\Module\ModuleController;
use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Page\Page;
use App\Models\Post\Post;
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
    $templates = ModuleController::existingTemplates();

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
    $this->validator($request->all(), $this->getRulesTo('store'))->validate();

    $page = new Page();
    $page->name = makeSlug($request['name']);
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

    $this->userCheck('maintenance');
    $mypage = Page::where('name', $page)->first();
    if(!$mypage){
      //check if its a post
      $post = Post::where('slug', $page)->first();
      if($post) return (new PostController)->show($page);

      // DEV -> we want the admin to view a blank page with an option to add this page
      return view($this->pagenotfound);
    }

    if(!$mypage->public && Auth::guest())
      return redirect('/');

    $modules = ModuleController::getContents($mypage->name);
    $mypage->name = substr($mypage->name, 0, 1) === '/' ? substr($mypage->name, 1):$mypage->name;

    $url = $mypage->name;
    return view('pages.'.$mypage->template, compact('url','mypage','modules'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->userCheck('edit');
    $page = Page::find($id);

    if(!$page) return redirect('/');

    $templates = ModuleController::existingTemplates();
    return view('pages.edit', compact('page', 'templates'));
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

    $page->name = makeSlug($request['name']);
    $page->public = isset($request['public']) ? true:false;
    $page->template = isset($request['template']) ? $request['template']:'index';
    $page->save();

    return redirect('/admin/pages');
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
    if($id<=2) return redirect()->back();
    $page = Page::find($id);
    if(!$page) return redirect('/admin/pages');

    $page->delete();

    return redirect('/admin/pages');
  }

  /**
   * Redirects to homepage
   */
  public function home(  ){
    
    $this->userCheck('maintenance');
    $appname = config('app.name');
    $mypage = Page::find(1);
    $modules = ModuleController::getContents($mypage->name);
    $url = 'home';
    
    return view('pages.'.$mypage->template, compact('url', 'appname', 'mypage', 'modules'));
  }

  /**
   * Redirects to maintenance page
   */
  public function maintenance(  ){
    
    if(Auth::check() && Auth::user()->isAdmin()){}
    elseif(!Admin::isMaintenance()){ return redirect('/');}

    $appname = config('app.name');
    $mypage = Page::find(2);
    $modules = ModuleController::getContents($mypage->name);
    $url = 'maintenance';
    return view('pages.'.$mypage->template, compact('url','appname', 'mypage', 'modules'));
  }

  /**
   * Check for admin role
   * @param string $a
   */
  private function userCheck($a){
    switch ($a) {
      case 'create':
      case 'store':
      case 'edit':
      case 'update':
      case 'delete':
        if(Auth::check() && !Auth::user()->isAdmin())
          return redirect('/');
        break;
      case 'maintenance':
        if(Admin::isMaintenance()){
          if(Auth::check() && Auth::user()->isAdmin()) return false;
          return Redirect::to('/maintenance')->send();
        }
        break;
      default:
        return false;
        break;
    }
  }

}
