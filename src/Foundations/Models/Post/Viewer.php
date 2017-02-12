<?php

namespace Johnguild\Muffincms\Foundations\Models\Post;

// dependencies
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
// models

class Viewer extends Model
{
  	//

	/*--- Scopes ---*/
	public function scopeCreatedThisWeek( $query ){

		$s = Carbon::parse('this sunday')->toDateString();
		$e = Carbon::parse('this saturday')->toDateString();

		$query->whereBetween('created_at', [$s, $e]);
	}


	/*-- Weekly Report --*/
	public static function weeklyReport(){


		$sun = Carbon::parse('this sunday')->toDateString();
		$mon = Carbon::parse('this monday')->toDateString();
		$tue = Carbon::parse('this tuesday')->toDateString();
		$wed = Carbon::parse('this wednesday')->toDateString();
		$thu = Carbon::parse('this thursday')->toDateString();
		$fri = Carbon::parse('this friday')->toDateString();
		$sat = Carbon::parse('this saturday')->toDateString();


		$week = [];
		$week['sun'] = self::where('created_at', $sun)->count();
		$week['mon'] = self::where('created_at', $mon)->count();
		$week['tue'] = self::where('created_at', $tue)->count();
		$week['wed'] = self::where('created_at', $wed)->count();
		$week['thu'] = self::where('created_at', $thu)->count();
		$week['fri'] = self::where('created_at', $fri)->count();
		$week['sat'] = self::where('created_at', $sat)->count();

		return $week;
	}

}
