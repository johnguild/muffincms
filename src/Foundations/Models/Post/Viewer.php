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


	/*-- Monthly Report --*/
	public static function monthlyReport(){

		$s = Carbon::now()->startOfMonth();
		$e = Carbon::now()->endOfMonth();

		$dates = [];
		while ($s->lte($e)) {
		     $dates[] = $s->toDateString();
		     $s->addDay();
		}

		$count = [];
		foreach ($dates as $k => $d) {
			$count[] = self::where('created_at', $d)->count();
			$dates[$k] = substr($d, -2);
		}

		return array_combine($dates, $count);
	}


	/*-- Yearly Report --*/
	public static function yearlyReport($y=null){

		$year = [];

		$i = 1;
		while($i <= 12){
			if(!$y) $n = Carbon::now()->month($i);
			else $n = Carbon::now()->month($i)->year($y);
			
			$s = $n->startOfMonth()->toDateString();
			$e = $n->endOfMonth()->toDateString();

			$year[$n->format('F')] = self::whereBetween('created_at', [$s, $e])->count();

			$i++;
		}
		

		return $year;
	}
}
