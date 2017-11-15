<?php

namespace App\Http\Controllers\payment;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Http\Request;
use DB;
use App\Order;
use App\Plan;
use App\Package;
use App\State;
use App\Additional_item;
class PayuPament extends BaseController
{
	use ValidatesRequests;

	function paymentRequest(Request $request){
		$user_id = $request->session()->get('user_id');
		$order_id = $request->session()->get('order_id');
		$this->validate($request, [
            'address' => 'required',
            'city' => 'required',
            'shipping_state' => 'required|numeric',
            'zipcode' => 'required|numeric',
        ]);

        DB::beginTransaction();
		try {
			$shipping_address_insert_data = array(
	        	'order_id' => $order_id,
	        	'address' => $request->input('address'),
	        	'city' => $request->input('city'),
	        	'state_id' => $request->input('shipping_state'),
	        	'country_id' => '91',
	        	'zipcode' => $request->input('zipcode'),
	        );

	        //find and check before insert the business address record
	        $shipping_address = DB::table('shipping_addresses')
	        			->where('order_id', $order_id)
	        			->first();
			if($shipping_address === null){
				$shipping_address_id = DB::table('shipping_addresses')->insert($shipping_address_insert_data);
			}


			$order = DB::table('orders')
					->join('users', 'orders.user_id', '=', 'users.id')
					->join('plans', 'orders.plan_id', '=', 'plans.id')
					->join('packages', 'orders.pacakage_id', '=', 'packages.id')
					->join('customer_business_infos', 'orders.business_info_id', '=', 'customer_business_infos.id')
					->leftJoin('business_members', 'orders.user_id', '=', 'business_members.user_id')
					->leftJoin('business_categories', 'customer_business_infos.category', '=', 'business_categories.id')
					->leftJoin('business_roles', 'customer_business_infos.business_role_id', '=', 'business_roles.id')
					->leftJoin('business_addresses', 'customer_business_infos.business_address_id', '=', 'business_addresses.id')
					->leftJoin('states as business_state', 'business_addresses.state_id', '=', 'business_state.id')
					->leftJoin('country as business_country', 'business_addresses.country_id', '=', 'business_country.id')
					->leftJoin('shipping_addresses', 'orders.id', '=', 'shipping_addresses.order_id')
					->leftJoin('states as shipping_state', 'shipping_addresses.state_id', '=', 'shipping_state.id')
					->leftJoin('country as shipping_country', 'shipping_addresses.country_id', '=', 'shipping_country.id')
					->select(
						  'orders.*',

	                      'users.first_name as user_first_name',
	                      'users.last_name as user_last_name',
	                      'users.email as user_email',
	                      'users.mobile_number as user_mobile_number',

	                      'plans.title as plan_title',
	                      'plans.slug as plan_slug',
	                      'plans.description as plan_description',

	                      'packages.title as package_title',
	                      'packages.description as package_description',
	                      'packages.price as packages_price',
	                      'packages.state_fees as package_state_fees',

	                      'customer_business_infos.preferred_business_name as business_name',
	                      'customer_business_infos.alternate_business_name as business_alternate_name',
	                      'customer_business_infos.business_role_id',
	                      'customer_business_infos.category as bussiness_category_id',
	                      'customer_business_infos.describe_business as business_details',
	                      'customer_business_infos.business_address_id',

	                      'business_members.name as business_member_name',

	                      'business_categories.title as business_category_title',

	                      'business_roles.title as business_role_title',

	                      'business_addresses.address as business_address',
	                      'business_addresses.city as business_city',
	                      'business_addresses.state_id as business_state_id',
	                      'business_addresses.country_id as business_contry_id',
	                      'business_addresses.zipcode as business_zipcode',

	                      'business_state.name as business_state_name',

	                      'business_country.name as business_country_name',

	                      'shipping_addresses.address as shipping_address',
	                      'shipping_addresses.city as shipping_city',
	                      'shipping_addresses.state_id as shipping_state_id',
	                      'shipping_addresses.country_id as shipping_country_id',
	                      'shipping_addresses.zipcode as shipping_zipcode',

	                      'shipping_state.name as shipping_state_name',

	                      'shipping_country.name as shipping_country_name'
	                  )
					->where('orders.id',$order_id)->first();

				$payment_insert_data = array(
					'order_id' => $order_id,
					'total_price' => $order->packages_price,
					'payment_status' => '0',
					'payment_method' => 'PayuMoney',
					'created_at' => date('Y-m-d H:i:s')
				);
				//find and check before insert the payment address record
		        $payment_invoice = DB::table('payment_invoice')
		        			->where('order_id', $order_id)
		        			->first();
				if($payment_invoice === null){
					$payment_id = DB::table('payment_invoice')->insertGetId ($payment_insert_data);
				}else{
					$payment_id = $payment_invoice->id;
				}
				DB::commit();
		} catch(\Illuminate\Database\QueryException $ex){
			DB::rollback();
            dd($ex->getMessage()); 
            return redirect()->back()->with('error', 'Something wrong.Please Try again!');
        }
		/*echo '<pre>';
		print_r($order);
		//print_r($business_address);
		//print_r($request->session());
		echo '</pre>';
		die;*/
		/* All Required Parameters by your Gateway */
      
		$parameters = [
		'tid' => time().rand(111,999),
		'order_id' => $order_id,

		'amount' => '1.00',
		//'amount' => $order->packages_price,
		'firstname' => $order->user_first_name,
        'email' => $order->user_email,
        'phone' => $order->user_mobile_number,
        'productinfo' => 'Plan : '. $order->plan_title . ',Package : '. $order->package_title . ',Product name : ' . $order->business_name,
		];

		// Initiate Purchase Request and Redirect using the default gateway
		/*$order = Indipay::prepare($parameters);
		return Indipay::process($order);*/


		// Initiate Purchase Request and Redirect using any of the configured gateway
		// gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo

		$order = Indipay::gateway('PayUMoney')->prepare($parameters);
		return Indipay::process($order);
	}



	public function paymentSuccess(Request $request){

		$user_id = $request->session()->get('user_id');
		$order_id = $request->session()->get('order_id');
        // For default Gateway
        //$response = Indipay::response($request);
        
        // For Otherthan Default Gateway
        $response = Indipay::gateway('PayUMoney')->response($request);

        try {
        	if($response['status'] == 'success'){
        		$status = '1';
        	}else{
        		$status = '0';
        	}

        	$total = 0;
	        $orders = Order::find($order_id)->toArray();
	        $user_id = $orders['user_id'];
	        $plan_id = $orders['plan_id'];
	        $pacakage_id =$orders['pacakage_id'];
	        $additionalItems_id = json_decode($orders['additional_items_id']);
	        $state_id = $orders['state_id'];
			
			$getplans = Plan::with('getplan')->where('id',$plan_id)->first()->toArray();
			$getpackage = Package::with('getpackage')->where('id',$pacakage_id)->first()->toArray();
			$getstate_fees = State::with('getstate_fees')->where('id',$state_id)->first()->toArray();
			$getadditionalItems = Additional_item::select('title','price')->whereIn('id', $additionalItems_id)->get()->toArray();
			

	        $items['plans']=array('name' =>$getplans['title'],'qty'=>1);
	        $items['packages']=array('name' =>$getpackage['title'],'price'=>$getpackage['price'],'qty'=>1);
	        $total += $getpackage['price'] * 1;
	        for($i=0;$i<count($getadditionalItems);$i++){
	        	$items['additional'][$i]=array('name' =>$getadditionalItems[$i]['title'],'price'=>$getadditionalItems[$i]['price'],'qty'=>1);
	        	$total += $getadditionalItems[$i]['price'] * 1;
	        }
			

        	$payment_update_data = array(
	        	'txn_id' => $response['txnid'],
	        	'total_price' => $total,
	        	'payment_status' => $status,
	        	'invoice_description' => "Order for ".$getplans['title']." plan and ".$getpackage['title']." Package",
	        	'invoice_details' => json_encode($items),
	        	'updated_at' => $response['addedon']
	        );
        	
	        //update payment invoice record
			DB::table('payment_invoice')
				->where('order_id',$order_id)
				->update($payment_update_data);
    	} catch(\Illuminate\Database\QueryException $ex){
            //dd($ex->getMessage()); 
        }
        //$request->session()->flush();
        return view('payment.payumoney.success', compact('response'));
        //dd($response);
    
    }



    public function paymentFailure(Request $request){
    	$user_id = $request->session()->get('user_id');
		$order_id = $request->session()->get('order_id');
        // For default Gateway
        //$response = Indipay::response($request);
        
        // For Otherthan Default Gateway
        $response = Indipay::gateway('PayUMoney')->response($request);
        try {
        	if($response['status'] == 'success'){
        		$status = '1';
        	}else{
        		$status = '0';
        	}


	        $total = 0;
	        $orders = Order::find($order_id)->toArray();
	        $user_id = $orders['user_id'];
	        $plan_id = $orders['plan_id'];
	        $pacakage_id =$orders['pacakage_id'];
	        $additionalItems_id = json_decode($orders['additional_items_id']);
	        $state_id = $orders['state_id'];
			
			$getplans = Plan::with('getplan')->where('id',$plan_id)->first()->toArray();
			$getpackage = Package::with('getpackage')->where('id',$pacakage_id)->first()->toArray();
			$getstate_fees = State::with('getstate_fees')->where('id',$state_id)->first()->toArray();
			$getadditionalItems = Additional_item::select('title','price')->whereIn('id', $additionalItems_id)->get()->toArray();
			

	        $items['plans']=array('name' =>$getplans['title'],'qty'=>1);
	        $items['packages']=array('name' =>$getpackage['title'],'price'=>$getpackage['price'],'qty'=>1);
	        $total += $getpackage['price'] * 1;
	        for($i=0;$i<count($getadditionalItems);$i++){
	        	$items['additional'][$i]=array('name' =>$getadditionalItems[$i]['title'],'price'=>$getadditionalItems[$i]['price'],'qty'=>1);
	        	$total += $getadditionalItems[$i]['price'] * 1;
	        }
			

        	$payment_update_data = array(
	        	'txn_id' => $response['txnid'],
	        	'total_price' => $total,
	        	'payment_status' => $status,
	        	'invoice_description' => "Order for ".$getplans['title']." plan and ".$getpackage['title']." Package",
	        	'invoice_details' => json_encode($items),
	        	'updated_at' => $response['addedon']
	        );

	        //update payment invoice record
			DB::table('payment_invoice')
				->where('order_id',$order_id)
				->update($payment_update_data);
    	} catch(\Illuminate\Database\QueryException $ex){
            //dd($ex->getMessage()); 
        }
        //echo '<pre>';print_r($response);die;
        return view('payment.payumoney.failure', compact('response'));

        //dd($response);
    
    }
}
