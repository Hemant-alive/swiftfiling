@extends('layouts.site-layout')

@section('body')

  
    <div class="wrapper">
        <div class="container">
            <div class="col-sm-12">
              <div style="min-height: 300px;padding: 10px;">


              <?php
              //echo '<pre>';print_r($response);die;
                 echo "<h3>Your order status is ". $response['status'] .".</h3>";
                 echo "<h4>Your transaction id for this transaction is ".$response['txnid'].". You may try making the payment by clicking the link below.</h4>";
              ?>
              <p><a href="{{url('llc/place-order')}}"> Try Again</a></p>
              </div>

          </div>
        </div>
  </div>
@endsection