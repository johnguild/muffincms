<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Text;

// dependencies
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Text\Text;
use Auth;

trait TextController
{


  /**
   *  What view to show when /text/{wildcard} was not found
   */
  public $pagenotfound = 'pages.notfound';


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

    return view('texts.create', compact('url','location'));
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

    $res = Text::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $text = new Text();
    $text->url = $request['url'];
    $text->location = $request['location'];
    $text->global = ($request['global'] ? 1:0);
    $text->content = htmlentities($request['content']);
    $text->rank = $rank;
    $text->save();

    return redirect($text->url);
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

    $text = Text::find($id);
    if(!$text) return redirect('/');

    return view('texts.edit', compact('text'));
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

    $text = Text::find($request['id']);
    if(!$text) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $text->global = ($request['global'] ? 1:0);
    $text->content = htmlentities($request['content']);
    $text->save();

    return redirect('/'.$text->url);
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
    $text = Text::find($id);
    if(!$text) return redirect('/');

    $back = $text->url;
    $text->delete();

    return redirect('/'.$back);
  }

  /**
   * Display view for page not found
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
