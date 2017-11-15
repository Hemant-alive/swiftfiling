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
                      <li class="process-active">
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
        <div class="container custom-forth-level">
            <div class="row">
                  {!! Form::open(array('url'=>'llc/place-order','id'=>'login-form','class'=>'form-group')) !!}
                <div class="col-sm-8">
                  <div class="custom-forth-one-level">
                      <h2 class="pack-title">Who will be <span>the Registered Agent?</span></h2>
                      <p>By law, all incorporated businesses must have a Registered Agent on file with the state. A Registered Agent is someone that you designate to receive official documents for your business such as service of process, state correspondence, and other tax and legal documents.</p>
                      <h3>The many benefits of using our Registered Agent service include:</h3>
                      <ul>
                          <li>Keeping your information private</li>
                          <li>Securely storing all important mail for anytime online access</li>
                          <li>Mail fowarding of all legal documents directly to you</li>
                          <li>Keeping your business compliant with state requirements</li>
                          <li>Reducing junk mail</li>
                      </ul>
                      <h3>Who will serve as the registered agent for your Limited Liability Company?</h3>
                      <form>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input custom-registered-policy-one" type="radio" name="agent_info" id="exampleRadios1" value="1" checked="">
                                  I want Swyft Filings to provide my Registered Agent service</strong>
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input custom-registered-policy-two" type="radio" name="agent_info" id="exampleRadios2" value="2">
                                I will appoint a different Registered Agent</strong>
                            </label>
                          </div>
                      </form>
                      <p class="custom-provide-registered">By choosing Swyft Filings to provide your Registered Agent service, there will be no immediate charge. A charge of $149 will be processed after we have submitted your filing to the Secretary of State for approval. As long as your business is in operation, it is required to have a Registered Agent on file with the Secretary of State. We offer our service on a recurring annual basis to make sure your business is always in compliance with the law.</p>
                      <div class="custom-registered">
                          <h2>Who will be serving as your Registered Agent?</h2>
                          <p>Enter the physical address of the person or company including the suite number if applicable who will be serving as your Registered Agent.<span>Please note: your new company cannot serve as its own Registered Agent.</span></p>
                          <p>Please make sure your Registered Agent meets the following requirements:</p>
                          <ul>
                              <li>The Registered Agent has a physical address in the same state that you are forming your new business. P.O. Boxes are not allowed.</li>
                              <li>The Registered Agent is available to receive service of process on behalf of your company during business hours generally from 9am - 5pm Monday thru Friday.</li>
                          </ul>
                          <div method="get" class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="agent_name" id="Nane" placeholder="Name of Agent" value="{{@$agent_name}}">
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="agent_address" id="Nane" placeholder="Address" value="{{@$agent_address}}">
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="agent_city" id="Nane" placeholder="City" value="{{@$agent_city}}">
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <select name="state" class="form-control" data-required="true">
                                     <option value="">Select State</option>
                                        <?php foreach($state as $value) { ?>
                                      <option value="{{$value->id}}" <?php if($value->id==@$agent_state) { echo "selected"; } ?>>{{$value->name}}</option>
                                        <?php } ?>
                                    </select>
                                    <div class="custom-dd-arrow"></div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="Business_Location" placeholder="Zip Code">
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="custom-forth-two-level top_padding">
                      <h2 class="pack-title">Get your essential <span>business licenses and permits</span></h2>
                      <p>Many businesses need to obtain at least one license (sometimes several) before they can legally begin their normal daily operations. Let us take the hassle out of researching and finding the licenses and permits you need to operate your business.</p>
                      <p>Business Licenses and Permits Package <a href="#">(view sample package)</a></p>
                      <p>The Business Licenses and Permits Package tells you exactly which state, federal, and local government licenses, permits, and tax registrations that are required for your business. Your customized Business License Compliance Package will include:</p>
                      <ul>
                          <li>An overview of the licenses, permits, and tax registrations required for your business</li>
                          <li>Licensing authority contact information, including name, address, telephone number, etc.</li>
                          <li>The actual license, permit, and tax registration applications and associated documents</li>
                      </ul>
                      <h3>Would you like to receive a Business Licenses and Permits Package for your business?</h3>
                      
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="licenses_info" id="exampleRadios1" value="1" checked="">
                                    Yes, I would like a Business Licenses and Permits Package ($99)
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="licenses_info" id="exampleRadios2" value="2">
                                  No thank you
                            </label>
                          </div>
                      
                  </div> 
                  <div class="custom-forth-three-level">
                      <h2 class="pack-title">Do you want a free <span>consultation on reducing your taxes?</span></h2>
                      <p>We have partnered with a national accounting firm to provide you a FREE 30 minute consultation. The consultation will be focused on reducing your business taxes and other vital information regarding your business tax requirements.</p>
                      <h3>During your free 30 minute tax consultation and webinar, you will learn:</h3>
                      <ul>
                          <li>How your business is taxed</li>
                          <li>Commonly missed deductions</li>
                          <li>How to pay yourself the correct way</li>
                          <li>Using business bank accounts</li>
                          <li>What to do when your business has a loss or profit</li>
                          <li>How to stay in compliance with IRS tax requirements</li>
                          <li>And much more</li>
                      </ul>
                      
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="consultation_info" id="exampleRadios1" value="1" checked="">
                                   Yes, I would like to learn about reducing my tax expenses (Free)
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="consultation_info" id="exampleRadios2" value="2">
                                  No Thanks 
                            </label>
                          </div>
                      
                  </div>
                   <div class="float-right">
                      <button type="button" onclick="window.history.go(-1);" class="btn btn-primary"><i class="icon-double-angle-left"></i>Back</button> 
                      <button type="submit" class="btn btn-primary custom-next">Save and Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
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
   
