<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Text;

// dependencies
use Illuminate\Http\Request;
// models
use App\Models\Text\Text;
use Auth;

trait TextController
{

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
    if(!Auth::user()->isAdmin()){
        return redirect('/');
    }
    
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
    if(!Auth::user()->isAdmin()){
        return redirect('/');
    }

    $res = Text::select('rank')
                ->where([
                    ['url', $request['url']],
                    ['location', $request['location']]
                  ])
                ->first();
    $rank = ($res ? $res["rank"]+1 : 1);


    $text = new Text();
    $text->url = $request['url'];
    $text->location = $request['location'];
    $text->content = $request['content'];
    $text->rank = $rank;
    $text->save();


    return redirect($text->url);
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
    $text = Text::find($id);

    if(!$text || !Auth::user()->isAdmin()){
        return redirect('/');
    }

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

    $text = Text::find($request['id']);

    if(!$text || !Auth::user()->isAdmin()){
      return redirect('/');
    }

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
    $text = Text::find($id);

    if(!$text || !Auth::user()->isAdmin()){
      return redirect('/');
    }

    $back = $text->url;
    $text->delete();

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
}
