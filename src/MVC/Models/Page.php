<?php

namespace Johnguild\Muffincms\MVC\Models;

use Johnguild\Muffincms\MVC\Models\Viewer;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Page extends Model
{

	public function addNew($request)
	{
	    $this->name = makeSlug($request['name']);
	    $this->desc = $request['desc'];
	    $this->public = isset($request['public']) ? true:false;
	    $this->template = isset($request['template']) ? $request['template']:'home';
	    $this->save();
	}


	public function updateExisting($request)
	{
		$this->name = makeSlug($request['name']);
	    $this->desc = $request['desc'];
	    $this->public = isset($request['public']) ? true:false;
	    $this->template = isset($request['template']) ? $request['template']:'home';
	    $this->save();
	}


	public function viewers()
	{
		return $this->hasMany(Viewer::class);
	}

	public function viewersCount()
	{
		return $this->viewers()->count();
	}


	public function addViewer()
	{

		$dt = Carbon::now()->toDateString();
		// $dt = Carbon::tomorrow()->toDateString();
		// $dt = Carbon::yesterday()->toDateString();
		// $dt = Carbon::now()->startOfMonth()->toDateString();
		$viewer = Viewer::where([	['page_id', $this->id],
									['created_at', $dt],
									['ip', request()->ip()]
								])->first();
		if(!$viewer){
			$viewer = new Viewer();
			$viewer->page_id = $this->id;
			$viewer->ip = request()->ip();
			$viewer->created_at = $dt;
			$viewer->save();
		}
		
	}
}
