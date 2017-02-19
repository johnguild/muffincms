<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Admin;

// dependencies
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Validator;
use Input;
use Auth;
// models
use Johnguild\Muffincms\Foundations\Models\Admin\Admin;
use App\Models\Post\Viewer;
use App\Models\Page\Page;
use App\Models\Post\Post;
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


    $week = [];
    $week['new_posts'] = Post::createdThisWeek()->count();
    $week['report'] = Viewer::weeklyReport();
    $week['top_posts'] = Post::getTopViewedThisWeek();

    $month = [];
    $month['new_posts'] = Post::createdThisMonth()->count();
    $month['report'] = Viewer::monthlyReport();
    $month['top_posts'] = Post::getTopViewedThisMonth();

    $year = [];
    $year['report']['2017'] = Viewer::yearlyReport(2017);

    // return $year;
    return view('admins.dashboard', compact('week', 'month', 'year'));
  }

  public function posts()
  {
    $this->userCheck('posts');

    $posts = Post::paginate(10);

    return view('admins.posts', compact('posts'));
  }

  public function pages()
  {
    $this->userCheck('pages');

    $pages = Page::paginate(10);
    
    return view('admins.pages', compact('pages'));
  }

  public function settings()
  {
    $this->userCheck('settings');
    // Admin::toggleMaintenance(true);

    $maintenance = Admin::key('maintenance')->first(); 
    $maintenance = $maintenance->val;
    $maintenance['opening'] = isset($maintenance['opening'])  ? str_replace('+00:00', '', $maintenance['opening']) :'';

    return view('admins.settings', compact('maintenance'));
  }

  public function update(Request $request)
  {
    $this->userCheck('update');

    if(isset($request['maintenance'])){
      $maintenance = Admin::key('maintenance')->first();
      $tmp = $maintenance->val;
      // DEV - update this when opening date is enabled
      if(!isset($request['mn'])) $tmp = array('on'=>false);
      foreach ($tmp as $key => $value) {
        if(isset($request['mn'][$key])) $tmp[$key] = $request['mn'][$key];
      }
      $maintenance->val = $tmp;
      $maintenance->save();
    }

    return redirect('/admin/settings');
  }


  /**
   * Check for admin role
   * @param int $id
   */
  private function userCheck($a){
    switch ($a) {
      case 'update':
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
