<?php

namespace App\Http\Controllers\Image;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Image\ImageController as MuffinImageController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
// models
use App\Models\Image\Image;


class ImageController extends Controller
{
   use MuffinImageController;

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
        ];
        break;
      case 'store':
      default:
        return [
          'url'       => 'required|max:255',
          'location'  => 'required|max:255',
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

    $res = Image::select('rank')->where([['url', $request['url']],['location', $request['location']]])->first();
    $rank = ($res ? $res["rank"]+1 : 1);

    $image = new Image();
    $image->url = $request['url'];
    $image->location = $request['location'];
    $image->global = ($request['global'] ? 1:0);
    $image->rank = $rank;
    $image->alt = isSetted($request['alt']);
    $image->image = isSetted($request['image']);
    $image->save();

    return redirect($image->url);
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
    $image->alt = isSetted($request['alt']);
    $image->image = isSetted($request['image']);
    $image->save();

    return redirect('/'.$image->url);
  }

}
