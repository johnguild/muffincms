<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Text;

// dependencies
use Illuminate\Http\Request;
// models
use App\Models\Text\Text;
use Auth;

trait TextController
{
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
}
