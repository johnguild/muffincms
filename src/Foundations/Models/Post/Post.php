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
	public function scopeCreatedThisWeek( $query ){

		$s = Carbon::parse('this sunday')->toDateString();
		$e = Carbon::parse('this saturday')->toDateString();

		$query->whereBetween('created_at', [$s, $e]);
	}


	public function scopeCreatedThisMonth( $query ){

		$s = Carbon::now()->startOfMonth()->toDateString();
		$e = Carbon::now()->endOfMonth()->toDateString();

		$query->whereBetween('created_at', [$s, $e]);
	}

	/*--- Custom ----*/

	public function addViewer()
	{

		// $dt = Carbon::now()->toDateString();
		// $dt = Carbon::tomorrow()->toDateString();
		// $dt = Carbon::yesterday()->toDateString();
		$dt = Carbon::now()->startOfMonth()->toDateString();
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

	public static function getTopViewedThisWeek(){

	    $s = Carbon::parse('this sunday')->toDateString();
	    $e = Carbon::parse('this saturday')->toDateString();
	    $res = Post::whereHas('viewers', function($q) use($s, $e){
	                      $q->whereBetween('created_at', [$s, $e]);
	                  })->take(4)->get();

	    return $res;
	}

	public function getThisWeekViewCount(){
		$s = Carbon::parse('this sunday')->toDateString();
		$e = Carbon::parse('this saturday')->toDateString();
		return Viewer::where('post_id',$this->id)->whereBetween('created_at',[$s, $e])->count();
	}

}
