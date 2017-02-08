<?php

namespace Johnguild\Muffincms\Foundations\Models\Post;

// dependencies
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;
use Carbon\Carbon;
// models
use App\Models\Post\Viewer;

class Post extends Model
{
  
	protected $guarded = [ 'id' ];
	protected $appends = array('total_viewers');



	/*--- Mutators ---*/

	public function getTotalViewersAttribute(){
		
		return Viewer::where('post_id',$this->id)->count();
	}


	/*--- Relations ---*/

	public function viewers(  ){
		return $this->hasMany(Viewer::class);
	}

	
	/*--- Scopes ---*/
	// public function scopeToday( $query ){

	// 	$dt = Carbon::now()->toDateString();
	// 	$id = $this->id;

	// 	// $query->with(array('viewers' => function($q) use($id,$dt){
	// 	// 	$q->where([
	// 	// 				['post_id', '=', $id],
	// 	// 				['created_at', '=', $dt]
	// 	// 			]);
	// 	// }));
	// }


	/*--- Custom ----*/

	public function addViewer()
	{

		$dt = Carbon::now()->toDateString();
		// $dt = Carbon::tomorrow()->toDateString();
		// $dt = Carbon::yesterday()->toDateString();
		$viewer = Viewer::where([	['post_id', $this->id],
									['created_at', $dt],
									['ip', request()->ip()]
								])->first();
		if(!$viewer){
			$viewer = new Viewer();
			$viewer->post_id = $this->id;
			$viewer->ip = request()->ip();
			$viewer->created_at = $dt;
			$viewer->save();
		}
		
	}



}
