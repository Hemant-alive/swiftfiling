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
                      <li class="process-active">
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
        {!! Form::open(array('url'=>'llc/contact','id'=>'package-form','class'=>'form-inline form-grou')) !!}
        <div class="container custom-first-level">
            <div class="row">
                <div class="col-sm-10">
                    <h2 class="pack-title">Incorporate <span>Your Business in 3 Easy Steps</span></h2>
                    <p class="pg-title">You can incorporate your business in 10 minutes or less. Plus, each package is backed by our<a href="#">100% Satisfaction Guarantee</a>
                    </p>
                    <div class="clearfix"></div>
                    <ul class="list-inline custom-form-field">
                        <li>
<!--                          <form method="get" action="" class="form-inline form-group">-->
                            <span>1</span>
                            <select name="business_type" class="form-control" onchange="getbusinessdetails(this.value);">
                              <option value="">Choose Your Business Type</option>
                               <?php foreach($plans as $value) { ?>
                              <option value="{{$value->id}}" <?php if($business_type==$value->id) { echo 'selected'; } ?>>{{$value->title}}</option>
                              <?php } ?>
                            </select>
                            <div class="custom-dd-arrow"></div>
<!--                            </form>-->
                        </li>
                        <li>
<!--                          <form method="get" action="" class="form-inline form-group">-->
                           <span>2</span>
                           <div class="form-group">
                              <select name="state" id="state" class="form-control" onchange="getstateprice(this.value);" required="required">
                                <option value="">CHOOSE YOUR STATE OF FORMATION</option>
                                <?php foreach($state as $value) { ?>
                                    <option value="{{$value->id}}" <?php if($state_id==$value->id) { echo 'selected'; }?>>{{$value->name}}</option>
                                    <?php } ?>
                                
                              </select>
                              <div class="custom-dd-arrow"></div>
                           </div>
<!--                           </form>-->
                        </li>
                    </ul>
                    <table class="table table-striped table-responsive custom-package-form-wrapper">
                        <colgroup></colgroup>
                        <colgroup></colgroup>
                        <colgroup></colgroup>
                        <colgroup></colgroup>
                          <thead>
                            <tr >
                              <th>
                                  <span>3</span><h2>Select a Package</h2>
                                  <h3>The Swyft Filings Advantage</h3>
                                  <ul>
                                      <li><i class="icon-star-empty"></i>Lifetime Customer Support</li>
                                      <li><i class="icon-star-empty"></i>Real Time Online Order Status Tracking</li>
                                      <li><i class="icon-star-empty"></i><strong>SAME Business Day Processing</strong> <a href="#">Learn more</a></li>
                                      <li><i class="icon-star-empty"></i>Free Shipping on All Orders</li>
                                      <li><i class="icon-star-empty"></i>Our 100% Satisfaction Guarantee</li>
                                  </ul>
                              </th>
                               <?php $premimum_total=0;$standard_total=0;$basic_total=0; foreach($package as $value) { ?>
                               
                                <th>
                                    <?php 
                                    if($value->title=="Premimum") {
                                        $premimum_total=$value->price;
                                        $ppp=$value->id.'_'.$value->title.'_'.$value->price;
                                    }
                                    if($value->title=="Standard") {
                                        $standard_total=$value->price;
                                        
                                    }
                                    if($value->title=="Basic") {
                                        $basic_total=$value->price;
                                    }
                                    
                                    ?>
                                <h2>{{$value->title}}</h2>
                                <p>${{$value->price}} <span>+ state fees</span></p>
                                <p>{{$value->description}}</p>
                               
                                  <label class="custom-table-form radio-inline">
                                    <input onclick="getplan_package_price(this.value);" type="radio" <?php if($value->title=='Premimum') { echo 'checked'; } ?> name="optradio" value="{{$value->id.'_'.$value->title.'_'.$value->price}}">{{$value->title}}
                                   
                                  </label>
                               
                              </th>
                             
                              
                                  <?php } ?>
                              <input type="hidden" id="plan_package_price" name="plan_package_price" value="{{$ppp}}">
                            </tr>
                          </thead>

                          <tfoot>
                            <tr>
                              <th>&nbsp;</th>
                              <td>{!! Form::submit('Continue',array('class'=>'custom-continue-btn','id'=>'heroBtn')) !!}</td>
                              <td>{!! Form::submit('Continue',array('class'=>'custom-continue-btn','id'=>'heroBtn')) !!}</td>
                              <td>{!! Form::submit('Continue',array('class'=>'custom-continue-btn','id'=>'heroBtn')) !!}</td>
                            </tr>
                          </tfoot>

                          <tbody>
                            <tr>
                              <th>Click the icon to expand for more details!</th>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <?php foreach($additional_data as $value) { ?>
                            <tr>
                              <th><span>{{$value->title}}</span>
                                  <p class="table-hide-contant">{{$value->description}}</p>
                              </th>
                              <!--Premimum-->
                               <?php if($value->price!=0 && $value->p_title=='Premimum') { //$premimum_total+=$value->price; ?>
                              <td class="">
                                    <input name="premium_additional_price[]" type="checkbox" data-package="Premium" onclick="premium_additional_price();" data-processing-speed="Rush" value="{{$value->price.'_'.$value->id}}">
                                    <label>$<ct data-processing-speed="Rush">{{$value->price}}</ct></label>
                                </td>
                              <?php } else { ?>
                              <td class="inc">included</td>
                              <?php } ?>
                            <!--Standard-->
                               <?php if($value->price!=0 && $value->p_title=='Standard') {  //$standard_total+=$value->price; ?>
                              <td class="">
                                    <input name="standred_additional_price[]" onclick="standred_additional_price()" type="checkbox"  data-package="Premium" data-processing-speed="Rush" value="{{$value->price.'_'.$value->id}}">
                                    <label>$<ct data-processing-speed="Rush">{{$value->price}}</ct></label>
                                </td>
                              <?php } else { ?>
                              <td class="inc">included</td>
                              <?php } ?>
                             <!--Basic-->
                              <?php if($value->price!=0 && $value->p_title=='Basic') { //$basic_total+=$value->price; ?>
                              <td class="">
                                    <input name="basic_additional_price[]" type="checkbox" onclick="basic_additional_price();" data-package="Premium" data-processing-speed="Rush" value="{{$value->price.'_'.$value->id}}">
                                    <label>$<ct data-processing-speed="Rush">{{$value->price}}</ct></label>
                                </td>
                              <?php } else { ?>
                              <td class="inc">included</td>
                              <?php } ?>
                            </tr>
                            <?php } ?>
                           
                            
                            <tr>
                              <th class="text-right">package price:</strong></th>
                                <td class="" id="prim_package_price_td">${{$premimum_total}}</td><input type="hidden" name="prim_package_price" id="prim_package_price" value="{{$premimum_total}}">
                                <td class="" id="standred_package_price_td">${{$standard_total}}</td><input type="hidden" name="standred_package_price" id="standred_package_price" value="{{$standard_total}}">
                                <td class="" id="basic_package_price_td">${{$basic_total}}</td><input type="hidden" name="basic_package_price" id="basic_package_price" value="{{$basic_total}}">
                            </tr>
                            </tr>
                            <tr>
                              <th class="text-right totle_price">Arkansas State Fee:</th>
                                <td class="State_Fee_td">${{$state_fees->state_fees}}</td>
                                <td class="State_Fee_td">${{$state_fees->state_fees}}</td>
                                <td class="State_Fee_td">${{$state_fees->state_fees}}</td>
                                <input type="hidden" name="State_Fee" id="State_Fee" class="State_Fee_td">
                            </tr>
                            <tr>
                              <th class="text-right">Total:</th>
                                <td class="" id="prim_package_price_total">${{$premimum_total+$state_fees->state_fees}}</td><input type="hidden" name="prim_package_price_total_text" id="prim_package_price_total_text" value="{{$premimum_total+$state_fees->state_fees}}">
                                <td class="" id="standred_package_price_total">${{$standard_total+$state_fees->state_fees}}</td><input type="hidden" name="standred_package_price_total_text" id="standred_package_price_total_text" value="{{$standard_total+$state_fees->state_fees}}">
                                <td class="" id="basic_package_price_total">${{$basic_total+$state_fees->state_fees}}</td><input type="hidden" name="basic_package_price_total_text" id="basic_package_price_total_text" value="{{$basic_total+$state_fees->state_fees}}">
                            </tr>
                            </tr>
                          </tbody>

                    </table>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
         {!!Form::close()!!}
      <!--  <div class="container custom-next-level">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Who is the primary contact for the business?</h2>
                    <p>This is the person we will contact with all status updates related to the order.</p>
                    <form>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="Nane" placeholder="Contact first name">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="Business_Name" placeholder="Contact last name">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="text" class="form-control" id="Business_Location" placeholder="Phone No.">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact email address">
                              </div>
                          </div>
                      </div>
                      <div class="float-right">
                          <button type="submit" class="btn btn-primary"><i class="icon-double-angle-left"></i>Back</button> 
                          <button type="submit" class="btn btn-primary">Save and Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                      </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <div class="custom-price-sidebar">
                        <h1 class="text-center">My Order Summary</h1>
                        <ul>
                            <li><h2>Premium C Corp Package</h2><span>$299</span></li>
                            <li><h2>Alabama State Filing Fee</h2><span>$195</span></li>
                        </ul>
                        <ul class="custom-subgroup">
                            <h2>Compliance Services</h2>
                            <li><p>Obtain Federal Tax ID (EIN)</p><span>included</span></li>
                            <li><p>Banking Resolution</p><span>included</span></li>
                            <li><p>Custom Corporation Bylaws</p><span>included</span></li>
                            <li><p>Custom Organizational Minutes</p><span>included</span></li>
                            <li><p>Electronic Delivery of State Docs</p><span>included</span></li>
                            <li><p>Customized C Corp Kit</p><span>included</span></li>
                        </ul>
                        <ul class="custom-subgroup">
                            <h2>Expediting Option</h2>
                            <li><p>Express Alabama Processing</p><span>included</span></li>
                        </ul>
                        <ul class="custom-subgroup">
                            <h2>Shipping & Handling</h2>
                            <li><p> With Tracking #</p><span>included</span></li>
                        </ul>
                        <ul class="custom-subgroup-totle">
                            <li><P>Your Total:</P><span>$494.00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
   @endsection
    @section('script')
<script>
     $('#package-form').validate({

            rules: {
                
                business_type:{
                    required : true
                },
                state:{
                    required : true
                }
                
            },

            messages: {
                
               business_type:{
                   required : "Please Select Business Type!"
               },
                state:{
                    required : "Please Select State!"
                }
               
            }
        });
    function getstateprice(id){
        
        var cbc = document.getElementsByName('premium_additional_price[]');
            var premium_result = 0;
            for(var i=0; i<cbc.length; i++) 
            { 
                if(cbc[i].checked ) {
                premium_result += parseFloat(cbc[i].value);
                }
            }
        var cbc = document.getElementsByName('standred_additional_price[]');
            var standred_result = 0;
            for(var i=0; i<cbc.length; i++) 
            { 
                if(cbc[i].checked ) {
                standred_result += parseFloat(cbc[i].value);
                }
            }
        var cbc = document.getElementsByName('basic_additional_price[]');
            var basic_result = 0;
            for(var i=0; i<cbc.length; i++) 
            { 
                if(cbc[i].checked ) {
                basic_result += parseFloat(cbc[i].value);
                }
            }
        
       $.ajax({
                type: "GET",
                url: '{{url('getstateprice')}}',
                data: "state_id="+id,
                dataType:"html",
                success: function(msg)
                {
                   
                   var msg1='$'+msg;
                   $('.State_Fee_td').html(msg1);
                    
                   $('.State_Fee_td').val(msg);
                   var prim_package_price_total=parseFloat(msg)+parseFloat($('#prim_package_price').val())+premium_result;
                   $('#prim_package_price_total').html('$'+prim_package_price_total);
                   $('#prim_package_price_total_text').val(prim_package_price_total);
                   var standred_package_price_total=parseFloat(msg)+parseFloat($('#standred_package_price').val())+standred_result;
                   $('#standred_package_price_total').html('$'+standred_package_price_total);
                   $('#standred_package_price_total_text').val(standred_package_price_total);
                   var basic_package_price_total=parseFloat(msg)+parseFloat($('#basic_package_price').val())+basic_result;
                   $('#basic_package_price_total').html('$'+basic_package_price_total);
                   $('#basic_package_price_total_text').val(basic_package_price_total);
                }
             });
    }
    function premium_additional_price(){
       
       var cbc = document.getElementsByName('premium_additional_price[]');
            var result = 0;
            for(var i=0; i<cbc.length; i++) 
            { 
                if(cbc[i].checked ) {
                  
                result += parseFloat(cbc[i].value);
               
                }
            }
            //alert(result);
            var r=0;
            var r1=0;
            var prim_package_price=$('#prim_package_price').val();
            var prim_package_price_total_text=$('#prim_package_price_total_text').val();
                r=parseFloat(prim_package_price)+result;
                r1=parseFloat(prim_package_price_total_text)+result;
                $('#prim_package_price_td').html('$'+r);
                $('#prim_package_price_total').html('$'+r1);
    }
    function standred_additional_price() {

            var cbc = document.getElementsByName('standred_additional_price[]');
            var result = 0;
            for(var i=0; i<cbc.length; i++) 
            { 
                if(cbc[i].checked ) {
                result += parseFloat(cbc[i].value);
                }
            }

            var r=0;
            var r1=0;
            var standred_package_price=$('#standred_package_price').val();
            var standred_package_price_total_text=$('#standred_package_price_total_text').val();
                r=parseFloat(standred_package_price)+result;
                r1=parseFloat(standred_package_price_total_text)+result;
                $('#standred_package_price_td').html('$'+r);
                $('#standred_package_price_total').html('$'+r1);

    }
    
    function basic_additional_price() {

            var cbc = document.getElementsByName('basic_additional_price[]');
            var result = 0;
            for(var i=0; i<cbc.length; i++) 
            { 
                if(cbc[i].checked ) {
                result += parseFloat(cbc[i].value);
                }
            }

            var r=0;
            var r1=0;
            var basic_package_price=$('#basic_package_price').val();
            var basic_package_price_total_text=$('#basic_package_price_total_text').val();
                r=parseFloat(basic_package_price)+result;
                r1=parseFloat(basic_package_price_total_text)+result;
                $('#basic_package_price_td').html('$'+r);
                $('#basic_package_price_total').html('$'+r1);

    }
    function getbusinessdetails(id){
        var state_id=$('#state').val();
       // alert(state_id);
        url= '{{url('llc/package')}}';
        url += '?business_id=' + id;
        url += '&state=' + state_id;
        location = url;       
    }
    
    function getplan_package_price(val){
       // alert(val);
        $('#plan_package_price').val(val);
    }
 
    </script>
     @endsection