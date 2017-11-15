@extends('layouts.site-layout')
@section('body')
    <div class="wrapper">
        <div class="container">
              <div class="panel panel-default">
				  <div class="panel-heading">PayPal Payment Fail</div>
				  
				  <div class="panel-body">

				  	<h5 style="margin:0; font-size:24px; color:#6d879a; font-weight:600; font-family:calibri;" >Dear, <?php echo $response['userName'] ;?></h5>

					  <?php if($response['paypal_Invoice_id_success']==0){?>
						<div class="custom-thanks-page">
								<p><br />Something went wrong with your payment!<br />
								Your order number is: <span class='redtextB'><?php echo $response['paypal_Invoice_id']; ?></span><br />
								</p>
						</div>
						
					  <?php }?>
					  
					  <p><a href="{{url('llc/place-order')}}"> Try Again</a></p>
					  
				  </div>
			  </div>
        </div>
  </div>
@endsection