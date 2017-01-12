<?php

namespace App\Http\Controllers\Page;

// dependencies
use Johnguild\Muffincms\Foundations\Controllers\Page\PageController as MuffinPageController;
use App\Http\Controllers\Controller;
// models
use App\Models\Page\Page;


class PageController extends Controller
{

  use MuffinPageController;

  
  /**
   * Redirects to homepage
   */
  public function home(  ){
  	
  	$mypage = new Page();
  	$mypage->name = config('app.name');
  	return view('pages.home', compact('mypage'));
  }

}
