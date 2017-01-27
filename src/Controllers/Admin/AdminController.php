<?php

namespace App\Http\Controllers\Admin;

// dependencies
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Page\Page;
use App\User;


class AdminController extends Controller
{	

  public function __construct()
  {
  	 $this->middleware('auth');
  }

  /**
   * Show dashboard
   *
   */
  public function dashboard()
  {
    $this->userCheck('dashboard');
    return view('admins.dashboard');
  }

  public function posts()
  {
    $this->userCheck('posts');
    return view('admins.posts');
  }

  public function pages()
  {
    $this->userCheck('pages');

    $pages = Page::all();
    // return $pages;
    return view('admins.pages', compact('pages'));
  }


  public function create($module){
    switch ($module) {
      case 'posts':
        return view('posts.create');
        break;
      case 'pages':
        return view('pages.create');
        break;
      case 'settings':
        return view('settings.create');
        break;
      default:
        return view('pages.notfound');
        break;
    }
  }

  /**
   * Check for admin role
   * @param int $id
   */
  private function userCheck($a){
    switch ($a) {
      case 'dashboard':
      case 'posts':
      case 'pages':
      case 'settings':
        if(!Auth::user()->isAdmin())
          return redirect('/');
        break;
      default:
        return false;
        break;
    }
  }

}
