<?php

namespace App\Http\Controllers\Text;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Text\TextController as MuffinTextController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
// models
use App\Models\Text\Text;


class TextController extends Controller
{
  
  use MuffinTextController;

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
      return Validator::make($data, [
          'url'     	=> 'required|max:255',
          'location'  => 'required|max:255',
          'content'   => 'required|max:2000',
      ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $this->isForAdmin();
    $this->validator($request->all())->validate();

    $res = Text::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $text = new Text();
    $text->url = $request['url'];
    $text->location = $request['location'];
    $text->content = htmlentities($request['content']);
    $text->rank = $rank;
    $text->save();

    return redirect($text->url);
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

    $this->isForAdmin();
    $this->validator($request->all())->validate();

    $text = Text::find($request['id']);
    if(!$text) return redirect('/');

    $text->content = htmlentities($request['content']);
    $text->save();

    return redirect('/'.$text->url);
  }


}
