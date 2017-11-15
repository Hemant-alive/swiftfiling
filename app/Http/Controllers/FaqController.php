<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use DB;

class FaqController extends Controller
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


    public function index(Request $request)
    {

        // 

        $cat_id = Faq::select('id')->where('slug', $request->slug)->first()->toArray();

        $data['faqs'] = Faq::with(['question'])->where('id',$cat_id['id'])->first()->toArray();

        return view('faq',$data);

    }

}
