<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use state;
use plan;
use Package;
use App\User;
use App\Order;
use App\BusinessAddress;
use App\CustomerBusinessInfo;
use App\BusinessMember;
use Business_role;
use DB;
class LlcController extends Controller
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
        return view('llc/getstart',$data);
    }
    public function select_package(Request $request){
        error_reporting(0);
      $business_id=$request->business_id;
      if($business_id) {
          $business_type=$request->business_id;
      } else {
          $business_type=1;
      }
      $data['state_id'] =  $request->state;
      $data['business_type'] = $business_type;
      $data["state_fees"] = DB::table('states')->select('state_fees', 'id')->where('id',$request->state)->first();
      $data["state"] = DB::table('states')->select('name', 'id')->where('country_id',101)->get();
      $data["plans"] = DB::table('plans')->select('title','description', 'id')->where('status',1)->get();
      $data["package"] = DB::table('packages')->select('title','description','price','state_fees','id')->where('status',1)->where('plan_id',$business_type)->get();
      $data["additional_data"] = DB::table('additional_items')->leftjoin('packages','packages.id','=','additional_items.package_id')->select('additional_items.id','additional_items.title','additional_items.description','additional_items.price','packages.title as p_title')->where('additional_items.status',1)->where('additional_items.plan_id',$business_type)->get();
      return view('llc/llcPackage',$data);
    }
    
    public function getstateprice(Request $request){
        
        $state_fees = DB::table('states')->select('state_fees', 'id')->where('id',$request->state_id)->first();
        echo $state_fees->state_fees;
    }
    
    public function llc_contact(Request $request){
      // print_r($_POST);
        $plan_package_price=$request->plan_package_price;
        $plan_details=explode('_',$plan_package_price);
        $plan_id=$plan_details[0];
        $plan=$plan_details[1];
        $plan_price=$plan_details[2];
        $business_type=$request->business_type;
        if($plan=="Premimum"){
            $additional_details=$request->premium_additional_price;
        } else if($plan=="Standard"){
            $additional_details=$request->standred_additional_price;
        } else {
            $additional_details=$request->basic_additional_price;
        } 
        
        $additional_id='';
        for($i=0;$i<count($additional_details);$i++){
            $additional_ids=explode('_',$additional_details[$i]);
            $additional_id.=$additional_ids[1].',';
        }
       $additional_id = rtrim($additional_id,',');
       $additional_id =explode(',',$additional_id);
        //session
        $request->session()->put('package_text', $plan);
        $request->session()->put('package_price', $plan_price);
        $request->session()->put('business_type', $business_type);
        $request->session()->put('state', $request->state);
        $request->session()->put('plan_id', $plan_id);
        $request->session()->put('additional_id', $additional_id);
         $data["first_name"]=$request->session()->get('first_name');
         $data["last_name"]=$request->session()->get('last_name');
         $data["phone_number"]=$request->session()->get('phone_number');
         $data["email"]=$request->session()->get('email');
         
         $data["biz_name"]=$request->session()->get('biz_name');
         $data["biz_designator"]=$request->session()->get('biz_designator');
         $data["biz_name_optional"]=$request->session()->get('biz_name_optional');
         $data["primary_biz_designator"]=$request->session()->get('primary_biz_designator');
         $data["primary_biz_description"]=$request->session()->get('primary_biz_description');
         $data["biz_address"]=$request->session()->get('biz_address');
         $data["biz_city"]=$request->session()->get('biz_city');
         $data["biz_state"]=$request->session()->get('biz_state');
         $data["biz_zip_code"]=$request->session()->get('biz_zip_code');
        //data
        $data["package_text"] = $plan;
        $data["package_price"] = $plan_price;
        $data["plans"] = DB::table('plans')->select('title','description', 'id')->where('status',1)->where('id',$business_type)->first();
        $data["state_fees"] = DB::table('states')->select('state_fees','name', 'id')->where('id',$request->state)->first();
        $data["additional_data"] = DB::table('additional_items')
                                    ->leftjoin('packages','packages.id','=','additional_items.package_id')
                                    ->select('additional_items.title','additional_items.description','additional_items.price','additional_items.options','packages.title as p_title')
                                    ->where('additional_items.status',1)
                                    ->where('additional_items.plan_id',$business_type)
                                    ->where('additional_items.package_id',$plan_id)
                                    ->get();
        $data["additional_data_filter"] = DB::table('additional_items')->select('title','price', 'id')->whereIn('id',$additional_id)->get();
        return view('llc/llcContact',$data);
    }
    
    public function llc_business_info(Request $request){
     // print_r($_POST);die;
        $data["package_text"] = $request->session()->get('package_text');
        $data["package_price"] = $request->session()->get('package_price');
        $data["plans"] = DB::table('plans')->select('title','description', 'id')->where('status',1)->where('id',$request->session()->get('business_type'))->first();
        $data["state_fees"] = DB::table('states')->select('state_fees','name', 'id')->where('id',$request->session()->get('state'))->first();
        $data["additional_data"] = DB::table('additional_items')
                                    ->leftjoin('packages','packages.id','=','additional_items.package_id')
                                    ->select('additional_items.title','additional_items.description','additional_items.price','additional_items.options','packages.title as p_title')
                                    ->where('additional_items.status',1)
                                    ->where('additional_items.plan_id',$request->session()->get('business_type'))
                                    ->where('additional_items.package_id',$request->session()->get('plan_id'))
                                    ->get();
         $data["additional_data_filter"] = DB::table('additional_items')->select('title','price', 'id')->whereIn('id',$request->session()->get('additional_id'))->get();
         $data["business_roles"] = DB::table('business_roles')->select('title','id')->where('status',1)->get();
         $data["state"] = DB::table('states')->select('name', 'id')->where('country_id',101)->get();
          $data["category"] = DB::table('business_categories')->select('title', 'id')->where('status',1)->get();
         
        //form data
         if($_POST) {
         $first_name=$request->first_name;
         $last_name=$request->last_name;
         $phone_number=$request->phone_number;
         $email=$request->email;
         $password='123456';
         $request->session()->put('first_name', $first_name);
         $request->session()->put('last_name', $last_name);
         $request->session()->put('phone_number', $phone_number);
         $request->session()->put('email', $email);
         
         $check_mobile = DB::table('users')->select('id')->where('mobile_number',$phone_number)->first();
         $check_email = DB::table('users')->select('id')->where('email',$email)->first();
         if($check_mobile) {
            $user_id = $check_mobile->id; 
         } else if($check_email) {
             $user_id = $check_email->id; 
         } else {
             $user = new User([
              'role_id' =>3,
              'first_name' =>$first_name,
              'last_name' =>$last_name,
              'mobile_number' => $phone_number,
              'email' => $email,
              'status' => 0,
              'state' =>$request->session()->get('state'),
              'password' =>  bcrypt($password)
            ]);

            $user->save();
            $user_id = $user->id;
         }
            $check_order = DB::table('orders')->select('id')->where('user_id',$user_id)->first();
            if($check_order){
                $order_id = $check_order->id;
            } else {
                 $order = new Order([
              'user_id' =>$user_id,
              'plan_id' =>$request->session()->get('business_type'),
              'pacakage_id' =>$request->session()->get('plan_id'),
              'additional_items_id' => json_encode($request->session()->get('additional_id')),
              'state_id' => $request->session()->get('state')
             
            ]);

            $order->save();
            $order_id = $order->id;
            }
            $request->session()->put('user_id', $user_id);
            $request->session()->put('order_id', $order_id);
         }
         $data["biz_name"]=$request->session()->get('biz_name');
         $data["biz_designator"]=$request->session()->get('biz_designator');
         $data["biz_name_optional"]=$request->session()->get('biz_name_optional');
         $data["primary_biz_designator"]=$request->session()->get('primary_biz_designator');
         $data["primary_biz_description"]=$request->session()->get('primary_biz_description');
         $data["biz_address"]=$request->session()->get('biz_address');
         $data["biz_city"]=$request->session()->get('biz_city');
         $data["biz_state"]=$request->session()->get('biz_state');
         $data["biz_zip_code"]=$request->session()->get('biz_zip_code');
         $data["user_role"] = DB::table('user_roles')->select('role','id')->where('status',1)->get();
         return view('llc/llcBusinessInfo',$data);
    }
    public function llc_comliance(Request $request){
        // print_r($_POST);die;
         
          if($_POST) {
         $biz_name=$request->biz_name;
         $biz_designator=$request->biz_designator;
         $biz_name_optional=$request->biz_name_optional;
         $primary_biz_designator=$request->primary_biz_designator;
         $primary_biz_description=$request->primary_biz_description;
         $biz_address=$request->biz_address;
         $biz_city=$request->biz_city;
         $biz_state=$request->biz_state;
         $biz_zip_code=$request->biz_zip_code;
         
         $request->session()->put('biz_name', $biz_name);
         $request->session()->put('biz_designator', $biz_designator);
         $request->session()->put('biz_name_optional', $biz_name_optional);
         $request->session()->put('primary_biz_designator', $primary_biz_designator);
         $request->session()->put('primary_biz_description', $primary_biz_description);
         $request->session()->put('biz_address', $biz_address);
         $request->session()->put('biz_city', $biz_city);
         $request->session()->put('biz_state', $biz_state);
         $request->session()->put('biz_zip_code', $biz_zip_code);
         $check_address = DB::table('customer_business_infos')->select('id')->where('user_id',$request->session()->get('user_id'))->first();
         if($check_address){
             
             $order = Order::find($request->session()->get('order_id'));
             $order->managed_by = $request->ManagedBy;
            // $order->business_info_id = $CustomerBusinessInfo_id;
             $order->save();
         } else {
         $CustomerBusinessInfo = new CustomerBusinessInfo([
              'user_id' =>$request->session()->get('user_id'),
              'preferred_business_name' =>$biz_name,
              'alternate_business_name' =>$biz_name_optional,
              'business_role_id' => $biz_designator,
              'category' => 1,
              'describe_business' => 0
             
            ]);

            $CustomerBusinessInfo->save();
            $CustomerBusinessInfo_id = $CustomerBusinessInfo->id;
            
            $BusinessAddres = new BusinessAddress([
              'business_id' =>$CustomerBusinessInfo_id,
              'address' =>$biz_address,
              'city' =>$biz_city,
              'state_id' => $biz_state,
              'zipcode' => $biz_zip_code
             
            ]);
            $BusinessAddres->save();
            
             $order = Order::find($request->session()->get('order_id'));
             $order->managed_by = $request->ManagedBy;
             $order->business_info_id = $CustomerBusinessInfo_id;
             $order->save();
             
         }
            
            for($i=0;$i<count($request->add_manager);$i++) {
                if($request->add_manager[$i]) {
                    $BusinessMember = new BusinessMember([
                    'user_id' =>$request->session()->get('user_id'),
                    'role_id' =>$request->ManagedBy,
                    'Name' =>$request->add_manager[$i]
                    ]);
                    $BusinessMember->save();
                }
            }
            for($i=0;$i<count($request->add_member);$i++) {
                if($request->add_member[$i]) {
                    $BusinessMember = new BusinessMember([
                    'user_id' =>$request->session()->get('user_id'),
                    'role_id' =>$request->ManagedBy,
                    'Name' =>$request->add_member[$i]
                    ]);
                    $BusinessMember->save();
                }
            }
         }
        
        
         
         
        $data["package_text"] = $request->session()->get('package_text');
        $data["package_price"] = $request->session()->get('package_price');
        $data["plans"] = DB::table('plans')->select('title','description', 'id')->where('status',1)->where('id',$request->session()->get('business_type'))->first();
        $data["state_fees"] = DB::table('states')->select('state_fees','name', 'id')->where('id',$request->session()->get('state'))->first();
        $data["additional_data"] = DB::table('additional_items')
                                    ->leftjoin('packages','packages.id','=','additional_items.package_id')
                                    ->select('additional_items.title','additional_items.description','additional_items.price','additional_items.options','packages.title as p_title')
                                    ->where('additional_items.status',1)
                                    ->where('additional_items.plan_id',$request->session()->get('business_type'))
                                    ->where('additional_items.package_id',$request->session()->get('plan_id'))
                                    ->get();
         $data["additional_data_filter"] = DB::table('additional_items')->select('title','price', 'id')->whereIn('id',$request->session()->get('additional_id'))->get();
         $data["business_roles"] = DB::table('business_roles')->select('title','id')->where('status',1)->get();
         $data["state"] = DB::table('states')->select('name', 'id')->where('country_id',101)->get();
         
         return view('llc/llcComliance',$data);
    }
    
     public function llc_place_order(Request $request){
       // print_r($_POST);die;
        if($_POST) {
            
            $order = Order::find($request->session()->get('order_id'));
            $order->agent_info = $request->agent_info;
            $order->licenses =$request->licenses_info;
            $order->consultation = $request->consultation_info;
            $order->save();
            if($request->agent_info==2) { 
            $request->session()->put('agent_name', $request->agent_name);
            $request->session()->put('agent_address', $request->agent_address);
            $request->session()->put('agent_city', $request->agent_city);
            $request->session()->put('agent_state', $request->state);
            if($request->agent_name) {
             $BusinessMember = new BusinessMember([
                    'user_id' =>$request->session()->get('user_id'),
                    'role_id' =>6,
                    'Name' =>$request->agent_name
                    ]);
                    $BusinessMember->save();
            }
            }
        }
        $data["agent_name"] = $request->session()->get('agent_name');
        $data["agent_address"] = $request->session()->get('agent_address');
        $data["agent_city"] = $request->session()->get('agent_city');
        $data["agent_state"] = $request->session()->get('agent_state');
        $data["package_text"] = $request->session()->get('package_text');
        $data["package_price"] = $request->session()->get('package_price');
        $data["plans"] = DB::table('plans')->select('title','description', 'id')->where('status',1)->where('id',$request->session()->get('business_type'))->first();
        $data["state_fees"] = DB::table('states')->select('state_fees','name', 'id')->where('id',$request->session()->get('state'))->first();
        $data["additional_data"] = DB::table('additional_items')
                                    ->leftjoin('packages','packages.id','=','additional_items.package_id')
                                    ->select('additional_items.title','additional_items.description','additional_items.price','additional_items.options','packages.title as p_title')
                                    ->where('additional_items.status',1)
                                    ->where('additional_items.plan_id',$request->session()->get('business_type'))
                                    ->where('additional_items.package_id',$request->session()->get('plan_id'))
                                    ->get();
         $data["additional_data_filter"] = DB::table('additional_items')->select('title','price', 'id')->whereIn('id',$request->session()->get('additional_id'))->get();
         $data["business_roles"] = DB::table('business_roles')->select('title','id')->where('status',1)->get();
         $data["state"] = DB::table('states')->select('name', 'id')->where('country_id',101)->get();
         return view('llc/llcPlaceOrder',$data);
    }
}
