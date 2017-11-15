@extends('layouts.site-layout')




@section('body')

  
<!--  <div id="custom-banner" class="custom-banner custom-llc-banner">
        <div class="container">
            <div class="col-sm-12">
                <h1 class="text-center">Business Information</h1>
            </div>
        </div>
    </div> /Banner -->
 
    <div id="custom-llc-package" class="custom-llc-package-group">
        <div class="container">
            <div class="col-sm-12">
                  <ul class="list-inline text-center custom-pack-no">
                      <li>
                        <a href="#">
                            <span>1</span>
                            <div class="pack-group">
                                <p class="title">Customize Package</p>
                                <p class="subtitle">Build your custom package</p>
                            </div> 
                        </a>
                      </li>
                      <li><a href="#">
                            <span>2</span>
                            <div class="pack-group">
                              <p class="title">Contact Information</p>
                              <p class="subtitle">Primary contact for the business</p>
                            </div>
                      </a></li>
                      <li>
                          <a href="#">
                            <span>3</span>
                            <div class="pack-group">
                              <p class="title">Business Information</p>
                              <p class="subtitle">Basic details about your business</p>
                            </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                            <span>4</span>
                            <div class="pack-group">
                              <p class="title">Compliance</p>
                              <p class="subtitle">Business and tax setup</p>
                            </div>
                          </a>
                      </li>
                      <li class="process-active">
                        <a href="#">
                            <span>5</span>
                            <div class="pack-group">
                              <p class="title">Place Order</p>
                              <p class="subtitle">We incorporate your business</p>
                            </div>
                        </a>
                      </li>
                  </ul>
            </div>
        </div>
    </div>
    <div class="custom-package-wrapper">
        <div class="container custom-forth-level">
            <div class="row">
                <div class="col-sm-8">
				{!! Form::open(array('url'=>'llc/place-order','id'=>'place-order-form','class'=>'form-inline form-group business-form-group')) !!}
                  <div class="custom-forth-one-level">
                      <h2 class="pack-title">Please select <span>your payment option</span></h2>
                      <p>You have a couple of payment options to choose from. You may choose to pay in full now or you may choose to pay in installments.</p>
                      <div class="custom-payment-option">
                          <label class="form-check-label amount-payment-option">
                            <p class="bold text-success fs-18">Full Payment</p>
                            <span>Pay the total amount today</span>
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked="">$448.00
                          </label>
                          <label class="form-check-label card-payment-option">
                          <p class="bold text-success fs-18">2 Installment Payments</p>
                          <span>Pay in 2 Installment Payments</span>
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">$224.00
                          </label>
                      </div>
                  </div>
                  <div class="custom-fifth-two-level payment-otp-step top_padding">
                     <h2 class="pack-title">Complete your order for sxc</h2>
                      <p>Each order is backed by our <span>100% Satisfaction Guarantee</span></p>
                      <h4>Shipping Address</h4>
                      <p>This is where we will deliver your Alaska LLC Package after your filing has been approved by the state.</p>
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="city" id="City" placeholder="City">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <select name="shipping_state" class="form-control" data-required="true">
                                     <option value="">Select State</option>
                                        <?php foreach($state as $value) { ?>
                                      <option value="{{$value->id}}">{{$value->name}}</option>
                                        <?php } ?>
                                  </select>
                                  <div class="custom-dd-arrow"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="zipcopde" placeholder="Zip Code"  name="zipcode">
                                </div>
                            </div>
                        </div>

                  </div> 
                  <div class="custom-forth-three-level payment-otp-step">
                      <h4>Payment Information</h4>
                      <p>Please enter your payment information below to complete your order.</p>
                      <div class="form-group">
					  
                          <div class="form-check">
                            <label class="form-check-label custom-card-pay">
                              <input class="form-check-input" type="radio" checked="checked" name="payment_methods" src="{{ url('llc/place-order') }}" value="0">Credit / Debit Card</strong>
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label custom-paypal-pay">
                              <input class="form-check-input" type="radio" name="payment_methods" src="{{ url('paypal') }}" value="1"><img src="{{ asset('public/site/image/paypal.png') }}" alt="paypal" class="img-responsive" width="90"></strong>
                            </label>
                          </div>
						  <div class="form-check">
                            <label class="form-check-label custom-paypal-pay">
                              <input class="form-check-input" type="radio" name="payment_methods" src="{{url('payumoney/checkout') }}" value="2"><img src="{{ asset('public/site/image/payu_m.png') }}" alt="paypal" class="img-responsive" width="90"></strong>
                            </label>
                          </div>
						  
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="flip-container" id="flip-toggle">
                                      <div class="flipper">
                                        <div class="custom-hide-form row front">
                                          <div class="form-group col-sm-6">
                                              <span>Card Number *</span> 
                                              <input type="text" placeholder="Card Number" class="form-control" maxlength="20" data-stripe="number">
                                          </div>
                                          <div class="col-sm-6 img-bg-height">
                                            <img src="{{ asset('public/site/image/paypal-cards.png') }}" alt="paypal" class="img-responsive" width="250">
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="form-group col-sm-3">
                                            <span>Expiration Date *</span> 
                                            <input type="text" placeholder="MM/YY" class="form-control" maxlength="7" data-stripe="expiration"></div>
                                          <div class="form-group col-sm-3">
                                            <span>CVC *</span> 
                                            <input type="text" placeholder="123" class="form-control" maxlength="4" data-stripe="cvc">
                                          </div>
                                          <div class="col-sm-6 img-bg-height">
                                             <img src="{{ asset('public/site/image/verisign1.png') }}" alt="paypal" class="img-responsive" width="90">
                                             <img src="{{ asset('public/site/image/norton-header.png') }}" alt="paypal" class="img-responsive" width="90">
                                             <img src="{{ asset('public/site/image/godaddy.png') }}" alt="paypal" class="img-responsive" width="90">
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="form-group col-sm-7">
                                             <span>Billing Zip Code *</span>
                                             <input type="text" placeholder="5 digit zip code" class="form-control" maxlength="5" name="billing_zip" data-required="true">
                                          </div>
                                        </div>
                                        <div class="text-center custom-paypal-method back">
                                          <p>To pay with your PayPal account, simply click the button below login your PayPal account.</p>
                                          <a href="https://www.paypal.com/agreements/approve?nolegacy=1&ba_token=BA-01603646WH7280241"><img src="{{ asset('public/site/image/paypal.png') }}" alt="paypal" class="img-responsive" width="100"></a>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <p class="col-sm-12 text-left">By clicking Submit Order, I agree to the <a href="https://www.swyftfilings.com/legal/terms-of-service.php">Terms of Service.</a></p>
                          </div>
						  
                      </div>
                  </div>
                   <div class="float-right">
                      <button type="button" onclick="window.history.go(-1);" class="btn btn-primary"><i class="icon-double-angle-left"></i>Back</button> 
                      <button type="submit" class="btn btn-primary custom-next">Save and Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                    </div>
				{!!Form::close()!!}
                </div>
				 
                 <div class="col-sm-4">
                    <div class="custom-price-sidebar">
                        <h1 class="text-center">My Order Summary</h1>
                        <ul>
                            <li><h2>{{$package_text}} {{$plans->title}}</h2><span>${{$package_price}}</span></li>
                            <li><h2>{{$state_fees->name}} State Filing Fee</h2><span>${{$state_fees->state_fees}}</span></li>
                        </ul>
                          <!--additional filter-->
                        <ul class="custom-subgroup">
                            <?php $additional_price=0; foreach($additional_data_filter as $value)  { $additional_price+=$value->price; ?>
                            <li><p>{{$value->title}}</p><span>${{$value->price}}</span></li>
                            <?php }  ?>
                        </ul>
                        <?php  $o1=0; $o2=0; if(count($additional_data)>0) { ?>
                        <ul class="custom-subgroup">
                            <h2>Compliance Services</h2>
                            <?php  $i=1; foreach($additional_data as $value)  {  if($value->options==1) { $o1=1; }  if($value->options==0 && $i<=5) { ?>
                            <li><p>{{$value->title}}</p><span>included</span></li>
                            <?php } $i++; } ?>
                        </ul>
                        <?php } ?>
                        <?php if($o1==1) { ?>
                        <ul class="custom-subgroup">
                            <h2>Expediting Option</h2>
                            <?php $i=1; foreach($additional_data as $value) { if($value->options==1 ) { ?>
                            <li><p>{{$value->title}}</p><span>included</span></li>
                            <?php } $i++; } ?>
                        </ul>
                        <?php } ?>
                        <?php if($o2==1) { ?>
                        <ul class="custom-subgroup">
                            <h2>Shipping & Handling</h2>
                            <?php $i=1; foreach($additional_data as $value) { if($value->options==2) { ?>
                            <li><p> {{$value->title}}</p><span>included</span></li>
                             <?php } $i++; } ?>
                        </ul>
                         <?php } ?>
                        <ul class="custom-subgroup-totle">
                            <li><P>Your Total:</P><span>${{$package_price+$state_fees->state_fees+$additional_price}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endsection
      @section('script')
   
<script type="text/javascript">

	$("input[name=payment_methods]").click(function(e){
		var payment_methods = $(this).attr('src');
		$('#place-order-form').attr('action', payment_methods);
	});
	
    $('#place-order-form').validate({
            rules: {
                address:{
                    required : true
                },
                city:{
                    required : true
                },
                zipcopde:{
                    required : true,
                    number : true
                },
                shipping_state:{
                    required : true,
                }
                
            },
        });
    </script>
    @endsection
   
