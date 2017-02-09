<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Image;

// dependencies
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Image\Image;
use Auth;

trait ImageController
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
  public function create($myurl, $myloc)
  {
    $this->userCheck('create');
    
    $url = ($myurl ? $myurl : '');
    $location = ($myloc ? $myloc : '');

    return view('images.create', compact('url','location'));
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

    $res = Image::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $image = new Image();
    $image->url = $request['url'];
    $image->location = $request['location'];
    $image->global = ($request['global'] ? 1:0);
    $image->rank = $rank;
    $image->alt = $request['alt'];
    $image->image = $request['image'];
    $image->save();

    return redirect($image->url);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
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
    $image = Image::find($id);
    if(!$image) return redirect('/');

    return view('images.edit', compact('image'));
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
    $image = Image::find($request['id']);
    if(!$image) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $image->url = $request['url'];
    $image->location = $request['location'];
    $image->global = ($request['global'] ? 1:0);
    $image->alt = $request['alt'];
    $image->image = $request['image'];
    $image->save();

    return redirect('/'.$image->url);
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
    $image = Image::find($id);
    if(!$image) return redirect('/');
   
    $back = $image->url;
    $image->delete();

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
