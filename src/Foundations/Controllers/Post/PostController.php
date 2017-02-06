<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Post;

// dependencies
use App\Http\Controllers\Module\ModuleController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Post\Post;
use Auth;

trait PostController
{

  /**
   *  What view to show when /text/{wildcard} was not found
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
    $templates = ModuleController::existingTemplates('posts');
    return view('posts.create', compact('templates'));
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

    $post = new Post();
    $post->title = $request['title'];
    $post->slug = makeSlug($request['title']);
    $post->desc = $request['desc'];
    $post->image = $request['image'];
    $post->public = ($request['public'] ? 1:0);
    $post->template = $request['template'];
    $post->save();

    return redirect($post->slug);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    
    $this->userCheck('maintenance');
    $post = Post::where('slug', $slug)->first();

    if(!$post->public && Auth::guest())
      return redirect('/');

    return Carbon::now()->toDateString();

    $modules = ModuleController::getContents($post->title);
    $url = $post->slug;
    return view('posts.'.$post->template, compact('url','post','modules'));
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
    $post = Post::find($id);
    if(!$post) return redirect('/');

    $templates = ModuleController::existingTemplates('posts');
    return view('posts.edit', compact('post','templates'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $this->userCheck('update');
    $post = Post::find($request['id']);
    if(!$post) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $post->title = $request['title'];
    $post->slug = makeSlug($request['title']);
    $post->desc = $request['desc'];
    $post->image = $request['image'];
    $post->public = ($request['public'] ? 1:0);
    $post->template = $request['template'];
    $post->save();

    return redirect('/'.$post->slug);
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
    $post = Post::find($id);
    if(!$post) return redirect('/');
   
    $back = $post->slug;
    $post->delete();

    return redirect('/'.$back);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  protected function notfound()
  {
    return view($this->pagenotfound);
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
        if(Admin::isMaintenance())
          return Redirect::to('/maintenance')->send();
        break;
      default:
        return false;
        break;
    }
  }

}
