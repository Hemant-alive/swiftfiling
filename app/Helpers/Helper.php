<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use DB;

class Helper
{
	protected static $redirectTo = Illuminate\Http\Request;


    public static function getFaqCategories(){

    	$faqCategories = DB::table('faq_category')->select('title','slug', 'id')->where('status',1)->get()->toArray(); 
    	
    	return $faqCategories;
    }

}
