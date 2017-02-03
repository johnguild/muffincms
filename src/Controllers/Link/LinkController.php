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

  public function __construct()
  {
    $this->userCheck('maintenance');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data, array $rules)
  {   
    return Validator::make($data, $rules);  
  }

  /**
   * Get the appropriate rules for the request method
   * @param string $to
   * @param array $data
   * @return array $data
   */
  private function getRulesTo($to='store', $id=null){
    switch ($to) {
      case 'update':
        return [
          'url'       => 'required|max:255',
          'location'  => 'required|max:255',
          'title'     => 'required|max:255',
          'address'   => 'required|max:255',
        ];
        break;
      case 'store':
      default:
        return [
          'url'       => 'required|max:255',
          'location'  => 'required|max:255',
          'title'     => 'required|max:255',
          'address'   => 'required|max:255',
        ];
        break;
    }
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
    $link->global = ($request['global'] ? 1:0);
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
    $this->userCheck('update');
    $link = Link::find($request['id']);
    if(!$link) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $link->url = $request['url'];
    $link->location = $request['location'];
    $link->global = ($request['global'] ? 1:0);
    $link->title = $request['title'];
    $link->address = $request['address'];
    $link->alt = $request['alt'];
    $link->image = $request['image'];
    $link->new_window = ($request['new_window'] ? 1:0);
    $link->save();

    return redirect('/'.$link->url);
  }

}
