<?php

namespace App\Http\Controllers\Link;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Link\LinkController as MuffinLinkController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
// models
use App\Models\Link\Link;


class LinkController extends Controller
{
   use MuffinLinkController;

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
          'title'  		=> 'required|max:255',
          'address'   => 'required|max:255',
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

    $link = Link::find($request['id']);
    if(!$link) return redirect('/');

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

}
