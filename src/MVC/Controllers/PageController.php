<?php

namespace Johnguild\Muffincms\MVC\Controllers;

// dependencies
use App\Http\Controllers\Module\ModuleController;
use Johnguild\Muffincms\Traits\ModelSelector;
use Johnguild\Muffincms\MVC\Models\Admin;
use Johnguild\Muffincms\MVC\Models\Page;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// models
use Auth;


class PageController extends Controller
{

	use ModelSelector;

	// module rank ordering
	private $hierarchy = [
			'text'=>['rank','asc'],
			'link'=>['rank','asc'],
			'image'=>['rank','asc'],
		];

	// page not found folder and filename 
	public $pagenotfound = 'vendor.muffincms.pages.notfound';


	// show any page available
	public function show( $page='home' )
	{

		if(!$page)
			$page='home';

		if(Admin::isMaintenance() && Auth::guest())
			$page='maintenance';
		
		$mypage = Page::where('name', $page)->first();
		if(!$mypage){
			//check if its a post
			// $post = Post::where('slug', $page)->first();
			// if($post) return (new PostController)->show($page);
			// DEV -> we want the admin to view a blank page with an option to add this page
			return view($this->pagenotfound);
		}

		if(!$mypage->public && Auth::guest())
		return redirect('/');

		$mypage->addViewer();

		$modules = $this->getContents($mypage->name);
		$mypage->name = substr($mypage->name, 0, 1) === '/' ? substr($mypage->name, 1):$mypage->name;

		$url = $mypage->name;
		return view('vendor.muffincms.pages.'.$mypage->template, compact('url','mypage','modules'));
	}

	
	// redirect to page not found
	public function notfound()
	{
		return view($this->pagenotfound);
	}


	// get all modules instances from the url
	private function getContents( $url=null )
	{
		$modules = [];

		$models = $this->getModules();
		
		foreach ($models as $key => $mod) {
			$model = $mod;
			if($url)
				$modules[stripslashes($key)] = 
					$model::where('url', $url)
						->orWhere('global', true)
						->orderBy($this->hierarchy[$key][0], $this->hierarchy[$key][1])
						->get();
			else
				$modules[stripslashes($key)] = 
					$model::orderBy('rank','desc')
						->get();
		}

		return $modules;
	}


}
