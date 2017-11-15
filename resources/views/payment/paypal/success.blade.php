@extends('layouts.site-layout')

@section('body')
    <div class="wrapper">
        <div class="container">
              <div class="panel panel-default">
				  <div class="panel-heading">PayPal Payment Success</div>
				  
				  <div class="panel-body">
					  <?php if($response['paypal_Invoice_id_success']==1){?>
						<div class="custom-thanks-page">
						<h5 style="margin:0; font-size:24px; color:#6d879a; font-weight:600; font-family:calibri;" >Dear, <?php echo $response['userName'] ;?></h5>
							<h1>Thank you for your order</h1>
								<p>You will receive a confirmation email to <b></p>

							<h5><i class="icon icon-check-circle green"></i> Your order is placed successfully.</h5>  
							<h5>YOUR ORDER NUMBER: <span class="red"><?php echo $response['paypal_Invoice_id'];?></span></h5>
							<?php

							 print "<p>Your order is paid online by PayPal<br />Paid Amount :$ ".$response['AMT']."<br />Transaction ID: " .$response['Order_txn_id']. "</p>"
							?>
						</div>
						
						<div class="custom-your-dtl">
							 <h4>Your Order Details</h4>
								<?php $details = json_decode($response['Order_details']);?>
								<p>Plan name: <?php echo $details->plans->name;?></p>
								<p>Package name: <?php echo $details->packages->name;?></p>
								<p>Package Price: <?php echo $details->packages->price;?></p>
								
						 </div>
						  
					  <?php }?>
				  </div>
			  </div>
        </div>
  </div>
@endsection