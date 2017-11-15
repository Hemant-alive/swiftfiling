@extends('layouts.site-layout')




@section('body')

  
    <div id="custom-banner" class="custom-banner custom-llc-banner">
        <div class="container">
            <div class="col-sm-12">
                <h1 class="text-center">Form Your LLC Today in <br>as little as 10 Minutes</h1>
                <ul class="text-center">
                    <li>More businesses form as an LLC than any other entity type</li>
                    <li>Spend less time doing paperwork and more time running your business</li>
                    <li>Protect your personal assets from business debts or liabilities</li>
                </ul>
                {!! Form::open(array('url'=>'llc/package','id'=>'getStaet-form','class'=>'form-inline form-group custom-llc-form custom-top-form')) !!}

                  <div class="form-group">
                    <select name="state" class="form-control">
                      <option value="" selected="">CHOOSE YOUR STATE OF FORMATION</option>
                      <?php foreach($state as $value) { ?>
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      <?php } ?>
                     
                    </select>
                  </div>


                    
                    <div class="form-group">
                     
                      {!! Form::submit('Get Started',array('class'=>'btn btn-default','id'=>'getStaet-button')) !!}
                    </div>
                  {!!Form::close()!!}
                <h6 class="text-center">Starting at $49. <a class="bold" href="">View pricing 
                      <custom class="hidden-xs">details </custom>
                      <i class="fa fa-angle-right"></i></a> 
                </h6>
                <ul class="img-group text-center">
                    <li><img src="{{asset('public/site/image/verisign1.png')}}" class="img-responsive" alt="trust" width="80"></li>
                    <li><img src="{{asset('public/site/image/trust1.png')}}" class="img-responsive" alt="trust" width="130"></li>
                    <li><img src="{{asset('public/site/image/approved_icon.png')}}" class="img-responsive" alt="approved" width="90"></li>
                </ul>
            </div>
        </div>
    </div><!-- /Banner -->
    <div class="custom-started custom-llc-started">
        <div class="container">
          <div class="row text-center">
              <h2>Getting Started is Easy</h2>
              <p class="pg-title">Our three step process will have your business up and running Swyftly ™</p>
              <div class="col-sm-4 custom-tell custom-tell-llc">
                <div class="llc-img_circle">
                    <img src="{{asset('public/site/image/businessl.png')}}" alt="Tell" class="img-responsive" width="50">
                </div>
                <h3>Tell us about your business</h3>
                <p>We have taken the complexity out of forming your business. Our easy online form can be completed in as little as 10 minutes.</p>
              </div>
              <div class="col-sm-4 custom-paperwork custom-paperwork-llc">
                <div class="llc-img_circle">
                  <img src="{{asset('public/site/image/paperwork-llc2.png')}}" alt="Tell" class="img-responsive" width="50">
                </div>
                <h3>We file the paperwork</h3>
                <p>We incorporate your business by preparing all required documents and filing them directly with the Secretary of State.</p>
              </div>
              <div class="col-sm-4 custom-documents custom-documents-llc">
                <div class="llc-img_circle">
                    <img src="{{asset('public/site/image/paperwork-llc.png')}}" alt="Tell" class="img-responsive" width="45">
                </div>
                <h3>Receive your documents</h3>
                <p>Once your incorporation documents have been approved by the state, you will receive your completed LLC package by mail.</p>
              </div>
          </div>
            
        </div>
    </div><!-- /Custom Started -->
    <div class="custom-swyft-filings custom-llc-swyft-filings">
        <div class="container">
            <div class="row text-center">
              <h2>Why Business Owners Choose Swyft Filings</h2>
              <p class="pg-title">Every day businesses from all over the nation choose Swyft Filings to form their business. <br>Here are a just a few of the reasons why so many owners choose us to help start their business.</p>
              <div class="col-sm-4 custom-llc-experienced">
                  <div class="content-wrep-llc">
                      <div class="img_circle_two">
                        <img src="{{asset('public/site/image/llc-experience.png')}}" alt="Tell" class="img-responsive" width="60">
                      </div>
                      <h4>Trusted and Experienced</h4>
                      <p>Our Business Specialists will form your new business the correct way, saving you time and money by avoiding costly errors. Let us handle your business filings while you focus on growing your business.</p>
                  </div>
              </div>  
              <div class="col-sm-4 custom-llc-support">
                  <div class="content-wrep-llc">
                      <div class="img_circle_two">
                          <img src="{{asset('public/site/image/llc-support.png')}}" alt="Tell" class="img-responsive" width="70">
                      </div>
                      <h4>Personal Customer Support</h4>
                      <p>Each one of our customers is assigned a personal Business Specialist. Have a question? Just call your personal Business Specialist directly. No need to wait in a pool  of phone calls.</p>
                  </div>
              </div>  
              <div class="col-sm-4 custom-llc-turnaround">
                  <div class="content-wrep-llc">
                    <div class="img_circle_two">
                      <img src="{{asset('public/site/image/llc-turnaround.png')}}" alt="Tell" class="img-responsive" width="70">
                    </div>
                    <h4>Fast Turnaround Time</h4>
                    <p>When you place your order through Swyft Filings, we can immediately start the process of forming your new business. Our processing times are some of the fastest in the industry.</p>
                  </div>
              </div>  
            </div>
        </div>
    </div>
    <div class="ready-begin">
        <div class="container">
            <div class="row">
                <h2 class="text-center">Are You Ready to Begin?</h2>
                <div class="ready-begin_wrap">
                  <div class="col-sm-6 text-center">
                      <img src="{{asset('public/site/image/begin.png')}}" alt="begin" class="img-responsive" width="120">
                      <p class="text-center pg-title">Launch your business today starting at $49 + state fees.<br> <a href="/secure/order/?service=incorporation" class="blue-link fs-13">See detailed pricing <i class="fa fa-angle-right" style="margin-left: 1px;"></i></a> We also offer a 3-Easy Payment Plan to help get your business up and running quickly.</p>
                      <a class="btn btn-rounded btn-lg" href="#"> Start My LLC Today &nbsp; <i class="icon ti-arrow-circle-right text-white fs-18 pull-right hide-on-320"></i> </a>
                  </div>
                  <div class="col-sm-6">
                      <h2 class="text-center">Included in all of our packages</h2>
                      <ul class="">
                          <li></i>Verify Company Name Availability</li> 
                          <li></i>Preparation of Articles of Organization</li> 
                          <li></i>Document Filing with Secretary of State</li> 
                          <li></i>Dedicated Business Specialist</li><li></i>100% Satisfaction Guarantee</li> <li></i>Online Access to Your LLC Documents</li>
                          <li></i>Certificate of Incorporation</li> <li></i>Lifetime Customer Support</li>
                          <li></i>Delivery of Documents</li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="custom_llc_talk_business">
        <div class="container">
            <h2 class="text-center">Common Questions About Starting an LLC</h2>
            <p class="text-center pg-title">If you have more questions, please give us a call at <a class="font-open-sans" target="_blank" href="javascript:;"> (877) 777-0454</a> We love to help!</p>
            <div class="col-sm-6 custom-llc-accordion">
                <div id="accordion">
                    <ul class="">
                        <li>
                            <h2>Should I form my business as an LLC?</h2>
                            <div class="custom-tabber-wrapper">
                                <p>Despite being a relatively new option, the limited liability company (LLC) is now one of the most popular business structures among smaller organizations. While allowing business owners to remain free from a great deal of the regulations imposed on other types of companies, it still provides limited liability protection for its owners (members). This means that the personal assets of an LLC's ownership cannot be collected to fulfill the debts of the business.</p>
                            </div>
                        </li>
                        <li>
                            <h2>What is involved in forming an LLC?</h2>
                            <div class="custom-tabber-wrapper">
                                <p>All states require potential LLC owners to file a substantial set of documents, typically called the Articles of Organization, in order to establish their business. We can take care of this process for you, saving you time, effort, and allowing you to focus on developing your business – not filing paperwork.</p>
                            </div>
                        </li>
                        <li>
                            <h2>How should I name my LLC?</h2>
                            <div class="custom-tabber-wrapper">
                                <p>The name you choose for your LLC is an important decision, as it will be how you represent yourself to potential associates and clients. With that in mind, it is advisable that you take some time to craft a name that you will be proud to have representing you and your business.</p>

                                <p>Your name must be unique, and not deceptively similar, to any other trademarked name or business. It is also required that your name not be used to intentionally misrepresent the products or services you offer. For LLCs, nearly all states will also require you to add a signifier of your limited liability status, such as "LLC" or "L.L.C." to the end of your company's name. You may be able to operate under a name other than your formal LLC name by applying for and using a dba</p>
                            </div>
                        </li>
                        <li>
                            <h2>Are there a required number of individuals needed to form an LLC?</h2>
                            <div class="custom-tabber-wrapper">
                                <p>There is no minimum requirement as to the number of owners (also referred to as members) that an LLC must have. At the federal level, single-member LLCs qualify for pass-through taxation, however this is not always true at the state level.</p>
                            </div>
                        </li>
                    </ul>
                    <button class="btn btn-default custom-llc-btn text-center"><a href="#">View All LLC FAQs</a></button>
                </div>
            </div>
            <div class="col-sm-6 business-dtl text-center">
                <h4 class="uppercase mb16 pr-color-navy">
                  <span class="pr-color-lightest bold">Biz</span>
                  <span class="bold">Compare</span>
                  <sup class="trademark-sm">™</sup>
                </h4>
                <p>View and compare the different types of business structures to help you understand the benefits of each.</p>
            </div>
        </div>
    </div>

    <div class="custom-llc-start">
         {!! Form::open(array('url'=>'llc/package','id'=>'index-form','class'=>'')) !!}
        <div class="container">
            <h2 class="text-center">Ready to Start <span class="underline-img">Your Business</span>?</h2>
            <div class="col-sm-6 custom_search-left">
                <h2 class="text-center">Let's Get Started</h2>
                <div class="select-option-form">
                  <div class="select-option">
                    <select class="form-control">
                      <option value="" selected="">CHOOSE YOUR STATE OF FORMATION</option>
                        <?php foreach($state as $value) { ?>
                            <option value="{{$value->id}}" >{{$value->name}}</option>
                        <?php } ?>
                    </select>
                    <div class="custom-dd-arrow"></div>
                  </div>
                  <div class="select-option">
                    <select class="hero-cta-select bg-white form-control">
                      <option value="">Entity Type</option>
                        <?php foreach($plans as $value) { ?>
                            <option value="{{$value->id}}" >{{$value->title}}</option>
                        <?php } ?>
                    </select>
                    <div class="custom-dd-arrow"></div>
                  </div>
                      {!! Form::submit('Next Step &nbsp;',array('class'=>'btn btn-default','id'=>'btn float-right')) !!}
<!--                  <a class="btn float-right" href="/secure/order/?service=incorporation">Next Step &nbsp; <i class="fa fa-arrow-circle-right"></i></a>-->
                </div>
            </div>
            <div class="col-sm-6 custom_search-right">
                <p>Still have questions? We're here to help!<br> Call <strong>(877) 777-0450</strong> or Live Chat with us for real-time support.</p>
                
            </div>
        </div>
        {!!Form::close()!!}
    </div>
   @endsection
 @section('script')
   
<script>
    
    $('#getStaet-form').validate({

            rules: {
                
                state:{
                    required : true
                }
                
            },

            messages: {
                
               
                state:{
                    required : "Please Select State!"
                }
               
            }
        });
    </script>
    @endsection