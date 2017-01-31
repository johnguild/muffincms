<?php

namespace App\Http\Controllers\Div;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Div\DivController as MuffinDivController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
// models
use App\Models\Div\Div;


class DivController extends Controller
{
   use MuffinDivController;

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
        ];
        break;
      case 'store':
      default:
        return [
          'url'       => 'required|max:255',
          'location'  => 'required|max:255',
          'title'     => 'required|max:255',
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

    $res = Div::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $div = new Div();
    $div->url = $request['url'];
    $div->location = $request['location'];
    $div->global = ($request['global'] ? 1:0);
    $div->rank = $rank;
    $div->title = $request['title'];
    $div->image = $request['image'];
    $div->save();

    return redirect($div->url);
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
    $div->image = $request['image'];
    $div->save();

    return redirect('/'.$div->url);
  }

}
