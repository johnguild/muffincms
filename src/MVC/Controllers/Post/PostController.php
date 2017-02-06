<?php

namespace App\Http\Controllers\Post;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Post\PostController as MuffinPostController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
// models
use App\Models\Post\Post;


class PostController extends Controller
{

  use MuffinPostController;

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
          'title'  => 'required|max:1000|unique:posts,title,'.$id,
          'desc'   => 'required|max:5000'
        ];
        break;
      case 'store':
      default:
        return [
          'title'  => 'required|max:255|unique:posts',
          'desc'   => 'required|max:5000'
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


    $post = new Post();
    $post->title = $request['title'];
    $post->slug = makeSlug($request['title']);
    $post->desc = $request['desc'];
    $post->image = $request['image'];
    $post->public = ($request['public'] ? 1:0);
    $post->template = $request['template'];
    $post->save();

    return redirect($post->slug);
  }


  /**
   * Updates an existing resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $this->userCheck('update');
    $post = Post::find($request['id']);
    if(!$post) return redirect('/');

    $this->validator($request->all(), $this->getRulesTo('update', $request['id']))->validate();

    $post->title = $request['title'];
    $post->slug = makeSlug($request['title']);
    $post->desc = $request['desc'];
    $post->image = $request['image'];
    $post->public = ($request['public'] ? 1:0);
    $post->template = $request['template'];
    $post->save();

    return redirect('/'.$post->slug);
  }

}
