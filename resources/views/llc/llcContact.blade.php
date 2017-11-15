@extends('layouts.site-layout')




@section('body')

  
<!--  <div id="custom-banner" class="custom-banner custom-llc-banner">
        <div class="container">
            <div class="col-sm-12">
                <h1 class="text-center">Select LLC Package</h1>
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
                      <li class="process-active"><a href="#">
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
                      <li>
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
       
        <div class="container ">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Who is the primary contact for the business?</h2>
                    <p>This is the person we will contact with all status updates related to the order.</p>
                    {!! Form::open(array('url'=>'llc/business_info','id'=>'contact-form','class'=>'form-inline form-group business-form-group')) !!}
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Contact first name" value="{{$first_name}}">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Contact last name" value="{{$last_name}}">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone No." value="{{$primary_biz_description}}">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Contact email address" value="{{$email}}">
                              </div>
                          </div>
                      </div>
                      <div class="float-right">
                          <button type="button" onclick="window.history.go(-1);" class="btn btn-primary"><i class="icon-double-angle-left"></i>Back</button> 
                          <button type="submit" class="btn btn-primary">Save and Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
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
   
<script>
    
    $('#contact-form').validate({

            rules: {
                
                first_name:{
                    required : true
                },
                last_name:{
                    required : true
                },
                phone_number:{
                    required : true,
                    number : true
                },
                email:{
                    required : true,
                    email : true
                }
                
            },

            messages: {
                
               
                first_name:{
                    required : "Please Enter First Name!"
                },
                last_name:{
                    required : "Please Enter Last Name!"
                },
                phone_number:{
                    required : "Please Enter Phone Number!"
                },
                email:{
                    required : "Please Enter Email!"
                }
               
            }
        });
    </script>
    @endsection
