@extends('layouts.site-layout')




@section('body')

  
    <div id="custom-banner" class="custom-banner">
        <div class="container">
            <div class="col-sm-12">
                <div class=" animated fadeInDown">
                <h1 class="text-center">Do what you love. <br> We'll handle the paperwork.</h1>
                <p class="text-center">START YOUR BUSINESS WITH CONFIDENCE. AFFORDABLE. FAST. SIMPLE.</p>
               
                    {!! Form::open(array('url'=>'llc/package','id'=>'index-form','class'=>'form-inline form-group custom-top-form')) !!}
                    <div class="form-group">
                      <select name="business_id" class="form-control">
                        <option value="">Entity Type</option>
                       <?php foreach($plans as $value) { ?>
                              <option value="{{$value->id}}" >{{$value->title}}</option>
                              <?php } ?>
                      </select>
                       
                      <!-- <span class="text-danger">
                          Please choose your business type before selecting a package
                      </span> -->
                    </div>
                    <div class="form-group">
                      <select name="state" class="form-control business-select">
                        <option value="">State of formation</option>
                            <?php foreach($state as $value) { ?>
                               <option value="{{$value->id}}" >{{$value->name}}</option>
                            <?php } ?>
                      </select>
                      <!-- <span class="text-danger m-l-10 bold hide biz_type_error">
                        Please choose your business type before selecting a package
                      </span> -->
                    </div>
                    <div class="form-group">
                      
                      {!! Form::submit('Get Started',array('class'=>'btn btn-default','id'=>'heroBtn')) !!}
                    </div>
                 {!!Form::close()!!}
              </div>
            </div>
        </div>
    </div><!-- /Banner -->
    <div class="custom-started">
        <div class="container">
          <div class="row text-center">
              <h2>Getting Started is Easy</h2>
              <p class="pg-title">Our three step process will have your business up and running Swyftly ™</p>
              <div class="col-sm-4 custom-tell">
              <div class="animatedParent" data-sequence="1000">
                <div class="img_circle animated growIn go" data-id="1">
                    <img src="{{ asset('public/site/image/Tell.png') }}" alt="Tell" class="img-responsive" width="55">
                </div>
                </div>
                <h3>Tell us about your business</h3>
                <p>We have taken the complexity out of forming your business. Our easy online form can be completed in as little as 10 minutes.</p>
              </div>
              <div class="col-sm-4 custom-paperwork">
              <div class="animatedParent" data-sequence="1000">
                <div class="img_circle animated growIn go" data-id="1">
                  <img src="{{ asset('public/site/image/paperwork.png') }}" alt="Tell" class="img-responsive" width="55">
                </div>
              </div>  
                <h3>We file the paperwork</h3>
                <p>We incorporate your business by preparing all required documents and filing them directly with the Secretary of State.</p>
              </div>
              <div class="col-sm-4 custom-documents">
              <div class="animatedParent" data-sequence="1000">
                <div class="img_circle animated growIn go" data-id="1">
                    <img src="{{ asset('public/site/image/documents.png') }}" alt="Tell" class="img-responsive" width="55">
                </div>
              </div>  
                <h3>Receive your documents</h3>
                <p>Once your incorporation documents have been approved by the state, you will receive your completed LLC package by mail.</p>
              </div>
          </div>
            
        </div>
    </div><!-- /Custom Started -->
    <div class="custom-swyft-filings">
        <div class="container-fluid">
            <div class="row text-center">
              <h2>Why Business Owners Choose Swyft Filings</h2>
              <p class="pg-title">Every day businesses from all over the nation choose Swyft Filings to form their business. <br>Here are a just a few of the reasons why so many owners choose us to help start their business.</p>
              <div class="col-sm-4 custom-experienced">
                  <div class="content-wrep">
                      <div class="img_circle_two">
                        <img src="{{ asset('public/site/image/Experienced.png') }}" alt="Tell" class="img-responsive" width="33">
                      </div>
                      <h4>Trusted and Experienced</h4>
                      <p>Our Business Specialists will form your new business the correct way, saving you time and money by avoiding costly errors. Let us handle your business filings while you focus on growing your business.</p>
                  </div>
              </div>  
              <div class="col-sm-4 custom-support">
                  <div class="content-wrep">
                      <div class="img_circle_two">
                          <img src="{{ asset('public/site/image/support.png') }}" alt="Tell" class="img-responsive" width="33">
                      </div>
                      <h4>Personal Customer Support</h4>
                      <p>Each one of our customers is assigned a personal Business Specialist. Have a question? Just call your personal Business Specialist directly. No need to wait in a pool  of phone calls.</p>
                  </div>
              </div>  
              <div class="col-sm-4 custom-turnaround">
                  <div class="content-wrep">
                    <div class="img_circle_two">
                      <img src="{{ asset('public/site/image/Turnaround.png') }}" alt="Tell" class="img-responsive" width="33">
                    </div>
                    <h4>Fast Turnaround Time</h4>
                    <p>When you place your order through Swyft Filings, we can immediately start the process of forming your new business. Our processing times are some of the fastest in the industry.</p>
                  </div>
              </div>  
            </div>
        </div>
    </div>
    <div class="custom-trusted">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                  <h2>Trusted by thousands of businesses in all 50 states</h2>
                  <img src="{{ asset('public/site/image/star.png') }}" class="img-responsive" rel="star" width="130">
                  <span class="text-success">1000 + Reviews</span><br>
                  <span class="text-primary">No Fluff</span>
                  <p>Very quick and to the point. I appreciated that.</p>
                  <p>Johnny E <img src="{{ asset('public/site/image/verfy.png') }}" class="img-responsive" rel="star">Verified Order</p>
                </div>
            </div>
        </div>
    </div>
    <div class="custom_talk_business">
        <div class="container">
            <div class="col-sm-6">
                <h2>Let's Talk Business</h2>
                <p class="pg-title">No matter the business type, Swyft Filings can help you form your new company.</p>
                <div id="accordion">
                    <ul class="">
                        <li>
                            <h2>Limited Liabilty Company</h2>
                            <div class="custom-tabber-wrapper">
                                <h3>FORM A LIMITED LIABILTYa COMPANY (LLC)</h3>
                                <p>Nam ultrices et neque vel interdum! Nam tincidunt ut leo a molestie. Duis elit felis, imperdiet et sem et, convallis volutpat quam.
                                Sed mi velit, luctus ac ornare et, mollis et nibh? Vivamus gravida enim eget dolor lobortis congue. In hac habitasse platea dictumst. Donec a dui euismod, pellentesque odio id, congue nulla</p>
                                <button class="btn btn-default">Learn more <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li>
                            <h2>Form a C Corporation (C Corp)</h2>
                            <div class="custom-tabber-wrapper">
                                <h3>FORM A LIMITED LIABILTYa COMPANY (LLC)</h3>
                                <p>The C Corporation (C Corp) is what most people think of when they hear the word "corporation". Most large companies are formed under this structure as it offers the most tax related options for business owners. It provides the greatest level of separation between the company and its owners, and allows the company to raise capital through the issuance of publicly traded stock. However, the many formal requirements placed on C Corps prevent the structure from being the ideal choice for many smaller organizations. To learn more about forming an C Corp, click the link below.</p>
                                <button class="btn btn-default">Learn more <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li>
                            <h2>S Corporation</h2>
                            <div class="custom-tabber-wrapper">
                                <h3>Form a S Corporation (S Corp)</h3>
                                <p>The S Corporation (S Corp) structure is similar to the C Corp, with a few notable differences. The most important of these differences is that S Corps are eligible for special pass through taxation status with the IRS. This allows S Corp owners to avoid double taxation on their business income. S Corps must request pass through taxation status, by filing Form 2553 with IRS after successfully incorporating. To learn more about forming an S Corp, click the link below.</p>
                                <button class="btn btn-default">Learn more <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li>
                            <h2>Nonprofit</h2>
                            <div class="custom-tabber-wrapper">
                                <h3>Form a Nonprofit</h3>
                                <p>The Nonprofit corporation is a special type of business structure that exists to provide certain benefits to organizations that have as their main goal service to the public. Much like other formal business types, those who run Nonprofits are provided limited liability protection. To learn more about forming a Nonprofit, click the link below.</p>
                                <button class="btn btn-default">Learn more <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-sm-6">
                <img src="{{ asset('public/site/image/Liabilty-Company.jpg') }}" class="img-responsive">
            </div>
        </div>
    </div>
    <div class="custom_search_result">
        <div class="container">
            <div class="col-sm-6 custom_search-left">
                <img src="{{ asset('public/site/image/search.png') }}" class="img-responsive" width="70">
                <form>
                  <div class="input-group">
                        <input type="text" class="form-control" placeholder="Free business name search">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                      </span>
                  </div>
                </form>
                
            </div>
            <div class="col-sm-6">
                <h3 class="text-center">Find the Result</h3>
                <p class="text-center pg-title">Fill out the form below and we'll let you know if your<br> company name is available.</p>
                <form>
                  
                  <div class="form-group">
                    <input type="text" class="form-control" id="Business_Name" placeholder="Desire Business Name">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="Business_Location" placeholder="Business Location">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="Nane" placeholder="Your Name">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Get my results</button>
                </form>
            </div>
        </div>
    </div>
    <div class="custom_help">
        <div class="container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <h3>How Can We Help?</h3>
                    <p class="pg-title">Our Business Specialists are standing by. Call us at </p>
                    <span><img src="{{ asset('public/site/image/footer_phone_icon.png') }}"> 1-877-777-0450</span>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-default"><img src="{{ asset('public/site/image/chat_icon.png') }}">Live Chat</button>
                </div>
            </div>
        </div>
    </div>
   @endsection
   @section('script')
   
<script>
    
    $('#index-form').validate({

            rules: {
                business_id:{
                    required : true
                    
                },
                state:{
                    required : true
                }
                
            },

            messages: {
                
                business_id :{
                    required : "Please Select Business Type!"
                    
                },
                state:{
                    required : "Please Select State!"
                }
               
            }
        });
    </script>
    @endsection