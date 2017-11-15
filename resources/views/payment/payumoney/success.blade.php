@extends('layouts.site-layout')

@section('body')

  
    <div class="wrapper">
        <div class="container">
            <div class="col-sm-12">
              <div style="min-height: 300px;padding: 10px;">

              <?php
               	   
                echo "<h3>Thank You. Your order status is ". $response['status'] .".</h3>";
                echo "<h4>Your Transaction ID for this transaction is ".$response['txnid'].".</h4>";
                echo "<h4>We have received a payment of Rs. " . $response['amount'] . ". Your order will soon be shipped.</h4>";
              ?>
            </div>

          </div>
        </div>
  </div>
@endsection