<?php

namespace Johnguild\Muffincms\Foundations\Controllers\Page;

// dependencies
use Illuminate\Http\Request;
// models
use App\Models\Page\Page;

// development
use App\Http\Controllers\Module\ModuleController;


trait PageController
{

    protected $exceptions = [
            'products',
            'category'
        ];


    public $notfoundview = 'notfound';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {
        $mypage = Page::where('name', $page)->first();

        if(!$mypage || ($mypage && !$mypage->public)){
            return view('pages.'.$this->notfoundview);
        }

        $modules = ModuleController::getContents();

        return view('pages.'.$mypage->template, compact('modules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($page)
    {
        //
    }

}
