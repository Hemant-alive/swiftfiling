<?php

namespace App\Http\Controllers\payment;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Payment_invoice;
use App\Plan;
use App\State;
use App\Package;
use App\Additional_item;
use App\User;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;
use DB;
use Mail;
use PDF;

class PayPalController extends BaseController
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;


    public function __construct()
    {	
        $this->provider = new ExpressCheckout();
    }

	
	public function index(Request $request){
		$order_id = session()->get('order_id');
		
		if($order_id){
	
			$shipping_address_insert_data = array(
			'order_id' => $order_id,
			'address' => $request->input('address'),
			'city' => $request->input('city'),
			'state_id' => $request->input('shipping_state'),
			'country_id' => '91',
			'zipcode' => $request->input('zipcode'),
			);
			
			$shipping_address = DB::table('shipping_addresses')
			->where('order_id', $order_id)
			->first();
			
			if($shipping_address === null){
				DB::table('shipping_addresses')->insert($shipping_address_insert_data);
			}else{
				DB::table('shipping_addresses')->where('order_id',$order_id)->update(['address'=>$request->input('address'),'city'=>$request->input('city'),'state_id'=>$request->input('shipping_state'),'zipcode'=>$request->input('zipcode')]);
			}
			return redirect(url('paypal/ec-checkout')); 
		}else{
			return redirect(url('llc/start')); 
		}
	}
	 
    public function getExpressCheckout(Request $request)
    {
		if(!session()->get('order_id')){
			return redirect(url('llc/start')); 
		}
		
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $cart = $this->getCheckoutData($recurring);
        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');
			$response = "Error processing PayPal payment for Order".$invoice->id;
			return view('payment.paypal.success', compact('response'));
        }
    }

    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
		if(!session()->get('order_id')){
			return redirect(url('llc/start')); 
		}
		
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        $cart = $this->getCheckoutData($recurring);

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);


        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }
			
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }

            $invoice = $this->createInvoice($cart, $status,isset($response['TRANSACTIONID'])?$response['TRANSACTIONID']:0);



            //get userdetails
            $users_datails = DB::table('users')->select('users.first_name','users.last_name','users.email')
            ->leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->leftJoin('payment_invoice', 'payment_invoice.order_id', '=', 'orders.id')
            ->where('payment_invoice.order_id',session()->get('order_id'))->first();

            $response['userName'] = $users_datails->first_name.''.$users_datails->last_name;
            $response['userEmail'] = $users_datails->email;


            if ($invoice->payment_status) {
						
				$response['paypal_Invoice_id'] = $invoice->id;
				$response['paypal_Invoice_id_success'] = 1;
				$response['Order_details'] = $this->getCheckoutData()['desc'];
				$response['Order_txn_id'] = $invoice->txn_id;

                $pdf = PDF::loadView('payment.paypal.template.success',compact('response'));
                $pdf->setPaper('a4', 'portrait')->setWarnings(false)->save('public/invoice.pdf');

                Mail::send('payment.paypal.template.success',compact('response'), function ($smessage) use ($response) {
                     $smessage->to($response['userEmail'],$response['userName']);
                     $smessage->subject('Your Order Successfull!');
                     $smessage->attach('public/invoice.pdf');
                });

				session()->flush();
				return view('payment.paypal.success', compact('response'));
				
            } else {
				
				$response['paypal_Invoice_id'] = $invoice->id;
				$response['paypal_Invoice_id_success'] = 0;

                $pdf = PDF::loadView('payment.paypal.template.failure',compact('response'));
                $pdf->setPaper('a4', 'portrait')->setWarnings(false)->save('public/invoice.pdf');

                Mail::send('payment.paypal.template.failure', compact('response'), function ($smessage) use ($response) {
                     $smessage->to($response['userEmail'],$response['userName']);
                     $smessage->subject('Your Order failed!');
                     $smessage->attach('public/invoice.pdf');
                });

				return view('payment.paypal.failure', compact('response'));
				
            }

        }
    }

    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }

        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();

        $response = (string) $this->provider->verifyIPN($post);

        $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
        Storage::disk('local')->put($logFile, $response);
		
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */

    protected function getCheckoutData($recurring = false)
    {
		if(!session()->get('order_id')){
			return redirect(url('llc/start')); 
		}
		
        $data = [];
        $order_id = session()->get('order_id');
        $orders = Order::find($order_id)->toArray();
        $user_id = $orders['user_id'];
        $plan_id = $orders['plan_id'];
        $pacakage_id =$orders['pacakage_id'];
        $additionalItems_id = json_decode($orders['additional_items_id']);
        $state_id = $orders['state_id'];
		
		$getplans = Plan::with('getplan')->where('id',$plan_id)->first()->toArray();
		$getpackage = Package::with('getpackage')->where('id',$pacakage_id)->first()->toArray();
		$getstate_fees = State::with('getstate_fees')->where('id',$state_id)->first()->toArray();
		$getadditionalItems = Additional_item::select('title','price')
		 ->whereIn('id', $additionalItems_id)
		->get()->toArray();
		


        if ($recurring === true) {

            $data['items'] =[];
            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring');
            $data['subscription_desc'] ='';
            $data['cancel_url'] = url('/');

        } else {

            $total = 0;
            $items['plans']=array('name' =>$getplans['title'],'qty'=>1);
            $items['packages']=array('name' =>$getpackage['title'],'price'=>$getpackage['price'],'qty'=>1);
            $total += $getpackage['price'] * 1;
            for($i=0;$i<count($getadditionalItems);$i++){
            $items['additional'][$i]=array('name' =>$getadditionalItems[$i]['title'],'price'=>$getadditionalItems[$i]['price'],'qty'=>1);
            $total += $getadditionalItems[$i]['price'] * 1;
            }
			
			$data['items'] = [
                [
                    'name'  => $getplans['title'],
                    'price' => $total,
                    'qty'   => 1,
                ],
            ];
            $data['total'] = $total;
            $data['return_url'] = url('/paypal/ec-checkout-success');
            $data['invoice_description'] = "Order for ".$getplans['title']." plan and ".$getpackage['title']." Package";
            $data['cancel_url'] = url('llc/place-order');
			$data['invoice_id'] = config('paypal.invoice_prefix').rand().'_order_id'.$order_id;
			$data['desc'] = json_encode($items);
        }
		
        return $data;
    }

    /**
     * Create invoice.
     *
     * @param array  $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function createInvoice($cart, $status,$txn_id)
    {

        $invoice = new Payment_invoice();
        $invoice->invoice_description = $cart['invoice_description'];
        $invoice->invoice_details = $cart['desc'];
        $invoice->total_price = $cart['total'];
        $invoice->order_id = session()->get('order_id');
        $invoice->txn_id =$txn_id;
		$invoice->payment_method = 'PayPal';
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
           $invoice->payment_status = '1';
        } else {
           $invoice->payment_status = '0';
        }
		
        $invoice->save();
        return $invoice;
    }
	
}
