<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use state;
use plan;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data["plans"] = DB::table('plans')->select('title','description', 'id')->where('status',1)->get();  
      $data["state"] = DB::table('states')->select('name', 'id')->where('country_id',101)->get();
      return view('index',$data);
    }
}
