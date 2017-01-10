<?php

namespace App\Http\Controllers;
 
use Johnguild\Muffincms\Foundations\Controllers\TestController as MuffinTestController;

use App\Http\Controllers\Controller;
// use Carbon\Carbon;
 
class TestController extends Controller
{
 	
 	use MuffinTestController;

 		public function __construct(  ){
 			
 			
 		}


    public function index()
    {
       	return view('test');
    }
 
}