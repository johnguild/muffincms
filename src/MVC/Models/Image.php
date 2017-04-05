<?php

namespace Johnguild\Muffincms\MVC\Models;

// dependencies
use Illuminate\Database\Eloquent\Model;
// models

class Image extends Model
{
	public function addNew($request)
	{
		$res = $this::select('rank')
						->where([['url', $request['url']],['location', $request['location']]])
						->orderBy('created_at', 'desc')->first();
	    $rank = ($res ? $res["rank"]+1 : 1);

	    $this->url = $request['url'];
	    $this->location = $request['location'];
	    $this->global = isset($request['global']) ? 1:0;
	    $this->rank = $rank;
	    $this->alt = isSetted($request['alt']);
	    $this->image = isSetted($request['image']);
	    $this->save();
	}

	public function updateExisting($request)
	{

	    $this->url = $request['url'];
	    $this->location = $request['location'];
	    $this->global = isset($request['global']) ? 1:0;
	    $this->alt = isSetted($request['alt']);
	    $this->image = isSetted($request['image']);
	    $this->save();
	}
}
