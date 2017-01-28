<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Link;

// dependencies
use Illuminate\Http\Request;
// models
use App\Models\Link\Link;
use Auth;

trait LinkController
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

    return view('links.create', compact('url','location'));
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

    $res = Link::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $link = new Link();
    $link->url = $request['url'];
    $link->location = $request['location'];
    $link->rank = $rank;
    $link->title = $request['title'];
    $link->address = $request['address'];
    $link->alt = $request['alt'];
    $link->image = $request['image'];
    $link->new_window = ($request['new_window'] ? 1:0);
    $link->save();

    return redirect($link->url);
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
    $link = Link::find($id);
    if(!$link) return redirect('/');

    return view('links.edit', compact('link'));
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
    $link = Link::find($request['id']);
    if(!$link) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $link->url = $request['url'];
    $link->location = $request['location'];
    $link->title = $request['title'];
    $link->address = $request['address'];
    $link->alt = $request['alt'];
    $link->image = $request['image'];
    $link->new_window = ($request['new_window'] ? 1:0);
    $link->save();

    return redirect('/'.$link->url);
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
    $link = Link::find($id);
    if(!$link) return redirect('/');
   
    $back = $link->url;
    $link->delete();

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
        if(!Auth::user()->isAdmin())
          return redirect('/');
        break;
      default:
        return false;
        break;
    }
  }

}
