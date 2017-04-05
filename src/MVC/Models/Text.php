<?php

namespace Johnguild\Muffincms\MVC\Models;

// dependencies
use Illuminate\Database\Eloquent\Model;
// models

class Text extends Model
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
	    $this->title = isSetted($request['title']);
	    $this->content = htmlentities($request['content']);
	    $this->rank = $rank;
	    $this->save();

	}

	public function updateExisting($request)
	{

		$this->global = isset($request['global']) ? 1:0;
	    $this->content = htmlentities($request['content']);
	    $this->save();
	}
}
