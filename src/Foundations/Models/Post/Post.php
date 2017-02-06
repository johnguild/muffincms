<?php

namespace Johnguild\Muffincms\Foundations\Models\Post;

// dependencies
use Illuminate\Database\Eloquent\Model;
// models
use App\Models\Post\Viewer;

class Post extends Model
{
  
	protected $guarded = [ 'id' ];


	public function viewers(  ){
		return $this->hasMany(Viewer::class);
	}
}
