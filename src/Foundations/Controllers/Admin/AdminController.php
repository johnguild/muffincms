<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Admin;

// dependencies
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Page\Page;
use App\User;


trait AdminController
{	

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

  public function settings()
  {
    $this->userCheck('settings');
    Admin::toggleMaintenance(true);

    // return $pages;
    return view('admins.settings');
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
        if(Auth::check() && !Auth::user()->isAdmin())
          return redirect('/');
        break;
      default:
        return false;
        break;
    }
  }

}
