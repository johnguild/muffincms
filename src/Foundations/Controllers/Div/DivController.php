<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Div;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Module\ModuleController as MuffinModuleController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Div\Div;
use Auth;

trait DivController
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

    return view('divs.create', compact('url','location'));
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

    $res = Div::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $div = new Div();
    $div->url = $request['url'];
    $div->location = $request['location'];
    $div->global = ($request['global'] ? 1:0);
    $div->rank = $rank;
    $div->title = $request['title'];
    $div->image = isSetted($request['image']);
    $div->save();

    return redirect($div->url);
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
    $div = Div::find($id);
    if(!$div) return redirect('/');

    return view('divs.edit', compact('div'));
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
    $div = Div::find($request['id']);
    if(!$div) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $div->url = $request['url'];
    $div->location = $request['location'];
    $div->global = ($request['global'] ? 1:0);
    $div->title = $request['title'];
    $div->image = isSetted($request['image']);
    $div->save();

    return redirect('/'.$div->url);
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
    $div = Div::find($id);
    if(!$div) return redirect('/');

    $this->deleteContents($div);
    $back = $div->url;
    $div->delete();

    return redirect('/'.$back);
  }

  /**
   * Remove child modules inside the div
   *
   * @param  int  $id
   */
  protected function deleteContents($div)
  {
    $this->userCheck('delete');

    $modules = MuffinModuleController::getDeletableModules();
    foreach ($modules as $mod) {
      $loc = 'div'.$div->id.'-'.makeSlug($div->title);
      if($mod != 'Div'){
        $mod::where('location',$loc)->delete();
      }else{
        $subdiv = Div::where('location',$loc);
        $this->deleteContents($subdiv);
      }
    }
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
