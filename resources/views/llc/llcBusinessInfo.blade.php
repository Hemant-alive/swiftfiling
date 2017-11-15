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
                      <li class="process-active">
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
        <div class="container custom-third-level">
            <div class="row">
                 {!! Form::open(array('url'=>'llc/comliance','id'=>'business-form','class'=>'form-group')) !!}
                <div class="col-sm-8">
                  <div class="custom-third-one-level">
                        <h2 class="pack-title">What is the name <span>of your business?</span></h2>
                        <p>The state of Arkansas requires the legal name of a company to be unique from other businesses who are registered with the state. The business name you provide will be researched by Swyft Filings to ensure that it is available for registration.</p>
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="biz_name" name="biz_name" placeholder="Acme, LLC" value="{{$biz_name}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <select name="biz_designator" class="form-control" >
                                          <option value="">Select Designator</option>
                                         <?php foreach($business_roles as $value) { ?>
                                        <option value="{{$value->id}}"<?php if($value->id==$biz_designator) { echo 'selected'; } ?>>{{$value->title}}</option>
                                      <?php } ?>
                                        
                                      </select>
                                      <div class="custom-dd-arrow"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <input type="text" class="form-control" id="biz_name_optional" name="biz_name_optional" placeholder="Business Name optional" value="{{$biz_name_optional}}">
                                    </div>
                                </div>
                            </div>
                       
                  </div>
                  <div class="custom-third-two-level top_padding">
                      <h2 class="pack-title">What will be your <span>primary business activity?</span></h2>
                      <p>Choose the category below that best describes your business. If the categories provided do not describe your business, please select "Other". Then enter your own description in the box provided. Your answers will help us personalize your state formation documents.</p>
                     
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                    <select name="primary_biz_designator" class="form-control">
                                        <option value="">Select Category</option>
                                      <?php foreach($category as $value) { ?>
                                        <option value="{{$value->id}}" <?php if($value->id==$primary_biz_designator) { echo 'selected'; } ?>>{{$value->title}}</option>
                                      <?php } ?>
                                    </select>
                                    <div class="custom-dd-arrow"></div>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                    <input type="comment" class="form-control" id="primary_biz_description" name="primary_biz_description" placeholder="Please enter a brief description of your business activity" value="{{$biz_name_optional}}">
                                  </div>
                              </div>
                          </div>
                      
                  </div> 
                  <div class="custom-third-three-level">
                      <h2 class="pack-title">What is your <span>business address?</span></h2>
                      <p>Enter the physical address of your company including the suite number if applicable. The state of Alaska does not require a business address to form your entity. If you want, you may leave the fields blank and skip this step by clicking on the "Save and Continue" button. If you provide a business address, it can be located anywhere in the United States, however it cannot be a PO Box. If you run a home based business, you may enter your home address.</p>
                      
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="biz_address" name="biz_address" placeholder="Address" value="{{$biz_address}}">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="biz_city" name="biz_city" placeholder="City" value="{{$biz_city}}">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                    <select name="biz_state"  class="form-control">
                                        <option value="">Select State</option>
                                        <?php foreach($state as $value) { ?>
                                      <option value="{{$value->id}}" <?php if($value->id==$biz_state) { echo 'selected'; } ?>>{{$value->name}}</option>
                                        <?php } ?>
                                    </select>
                                    <div class="custom-dd-arrow"></div>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="biz_zip_code" name="biz_zip_code" placeholder="Zip Code" value="{{$biz_zip_code}}">
                                </div>
                            </div>
                          </div>
                     
                  </div> 
                   <div class="custom-third-four-level top_padding">
                      <h2 class="pack-title">How will your <span>LLC be managed?</span></h2>
                     
                          <div class="form-check">
                            <label class="form-check-label form-check-label-one">
                              <input class="form-check-input" type="radio" name="ManagedBy" id="exampleRadios1" value="2" checked>
                                The LLC will be managed by <strong>member(s)</strong>
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label form-check-label-two">
                              <input class="form-check-input" type="radio" name="ManagedBy" id="exampleRadios2" value="5">
                              The LLC will be managed by <strong>manager(s)</strong>
                            </label>
                          </div>
                     
                      <div class="custom-members">
                          <h2>Who are the Members (owners) of the business?</h2>
                          <div class="custom-members-wpapper">
                              <ol class="custom-select-lable">
                                  <li>
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="add_member[]" id="text" placeholder="Full Name">
                                      </div>
                                  </li>
                              </ol>
                          </div>
                          <a href="javascript:void(0)" class="addMembers btn btn-primary">
                            <i class="fa fa-plus-circle"></i> Add a <span class="managedBySingular fw-600">Member</span></a>
                      </div>
                      <div class="custom-manager">
                          <h2>Who are the Manager (owners) of the business?</h2>
                          <div class="custom-members-wrap">
                              <ol>
                                  <li>
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="add_manager[]" id="text" placeholder="Full Name">
                                      </div>
                                  </li>
                              </ol>
                          </div>
                          <a href="javascript:void(0)" class="addmanager btn btn-primary">
                            <i class="fa fa-plus-circle"></i> Add a <span class="managedBySingular fw-600">Manager</span></a>
                      </div>
                   </div> 
                   <div class="float-right">
                       <button type="button" onclick="window.history.go(-1);" class="btn btn-primary"><i class="icon-double-angle-left"></i>Back</button> 
                      <button type="submit" class="btn btn-primary custom-next">Save and Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
<!--                       {!! Form::submit('Save and Continue',array('class'=>'btn btn-primary custom-next','id'=>'heroBtn')) !!}-->
                    </div>
                </div>
                 {!!Form::close()!!}
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
     
    $('#business-form').validate({

            rules: {
                
                biz_name:{
                    required : true
               },
                biz_designator:{
                    required : true
                },
                biz_address:{
                    required : true
                   
                },
                biz_city:{
                    required : true
                    
                },
                biz_state:{
                    required : true
                },
                biz_zip_code:{
                    required : true,
                    number : true
                }
                
            },

            messages: {
                
               
                biz_name:{
                    required : "Please Enter Business Name!"
                },
                 biz_designator:{
                    required : "Please Select Designator Name!"
                },
                biz_address:{
                    required : "Please Enter Address!"
                },
                biz_city:{
                    required : "Please Enter City!"
                },
                biz_state:{
                    required : "Please Select State!"
                },
                biz_zip_code:{
                    required : "Please Enter Zip Code!"
                }
               
            }
        });
    </script>
    @endsection
