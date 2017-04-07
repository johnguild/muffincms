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
use Auth;


class PageController extends Controller
{

	use ModelSelector;

	// module order by
	private $hierarchy = [
			'text'=>['rank','asc'],
			'link'=>['rank','asc'],
			'image'=>['rank','asc'],
		];

	// page not found folder and filename 
	public $pagenotfound = 'vendor.muffincms.pages.notfound';

	// actual contents that are accessible to the views
	private static $contents = [];

	// actual page instance of the page
	private static $page;

	// show any page available
	public function show( $page='home' )
	{

		if(Admin::isMaintenance() && Auth::guest())
			$page='maintenance';
		
		$mypage = $this->feedContents($page);

		if(!$mypage){
			//check if its a post
			// $post = Post::where('slug', $page)->first();
			// if($post) return (new PostController)->show($page);
			$this->feedContents('home');
			return view($this->pagenotfound);
		}

		if(!$mypage->public && Auth::guest())
			return redirect('/');

		$mypage->addViewer();

		return view('vendor.muffincms.pages.'.$mypage->template);
	}

	
	// redirect to page not found
	public function notfound()
	{
		$this->feedContents('home');
		
		return view($this->pagenotfound);
	}

	// populate the contents
	public function feedContents($url='home')
	{

		$mypage = Page::where('name', $url)->first();

		if($mypage){
			$modules = [];

			foreach ($this->getModules() as $key => $mod) {
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

			// set modules
			self::$contents = $modules;

			// set page
			self::$page = $mypage;
		}

		return $mypage;
	}



	public static function getContents($mod, $loc)
	{
		$objects = self::$contents[$mod];

		return $objects->filter(function($item) use($loc){
			return $item->location == $loc;
		});
	}


	public static function getMyPage()
	{
		return self::$page;
	}

}
