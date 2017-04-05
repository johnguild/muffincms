<?php

namespace Johnguild\Muffincms\MVC\Controllers;

use Johnguild\Muffincms\Traits\TemplateSelector;
use Johnguild\Muffincms\MVC\Models\Admin;
use Johnguild\Muffincms\MVC\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    
    use TemplateSelector;

    // display dashboard
    public function showDashboard(Request $request)
    {
        
        $pages = [];
        $pages['count'] = Page::count();
        $pages['public'] = Page::where('public', true)->count();
        $pages['private'] = Page::where('public', false)->count();


        return view('muffincms::admin.dashboard',
                    compact('pages'));
    }

    
    // display pages
    public function showPages(Request $request)
    {   

        $pages = Page::paginate(5);

        foreach($pages as $p) { 
            $p->viewers = $p->viewersCount();
        }

        $templates = $this->existingTemplates();

        return view('muffincms::admin.pages',
                    compact('pages', 'templates'));
    }


    // display settings
    public function showSettings(Request $request)
    {

        $settings = Admin::all();

        return view('muffincms::admin.settings', 
                        compact('settings'));
    }


    public function updateSettings(Request $request)
    {


        $admin = Admin::find($request['id']);
        $admin->updateExisting($request->all());

        flash('success', $admin->key.' has been updated');
        return redirect('admin/settings');
    }
}
