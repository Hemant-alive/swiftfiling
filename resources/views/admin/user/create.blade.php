@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">New User</h3>
            <hr>
            <div class="grid_3 fulldiv">    
            <div class="col-lg-7">
                <div class="tab-content">
                    <!-- {{--    Error Display--}}
                        @if ($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                    {{--    Error Display ends--}} -->
                    <div class="tab-pane active" id="horizontal-form">
                        {!! Form::open(array('url'=>'admin/store','class'=>'form-horizontal','id'=>'newUser')) !!}
                            
                            <div id="msgStatus"></div>
                             <!-- <div class="form-group" style="display:none">
                                     {!! Form :: text('userType','3',['class'=>'form-control1', 'id'=>'userType'])  !!}                                                              
                            </div> -->
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-8">
                                     {!! Form :: text('firstName','',['class'=>'form-control1', 'id'=>'firstname'])  !!}
                                     @if ($errors->has('firstName'))
                                        <div class="error">{{ $errors->first('firstName') }}</div>
                                     @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    {!! Form :: text('lastName','',['class'=>'form-control1', 'id'=>'lastname'])  !!}
                                    @if ($errors->has('lastName'))
                                        <div class="error">{{ $errors->first('lastName') }}</div>
                                    @endif
                                </div>                                
                            </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-8">
                                    {!! Form :: text('mobile','',['class'=>'form-control1', 'id'=>'mobile'])  !!}
                                    @if ($errors->has('mobile'))
                                        <div class="error">{{ $errors->first('mobile') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
				<label class="col-sm-2 control-label">Email</label>
				<div class="col-sm-8">	
                                     {!! Form :: text('email','',['class'=>'form-control1', 'id'=>'email'])  !!}
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
				</div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-8">
                                    {!! Form :: password('password',['placeholder'=>'Minimum 6 characters','class'=>'form-control1'])  !!}
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-8">
                                    {!! Form :: password('password_confirmation',['placeholder'=>'Minimum 6 characters | Same as Password','class'=>'form-control1'])  !!}
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2">
                            {!! Form :: submit("Save User",["class"=>"btn-success btn",'id'=>'user']) !!}
                            </div>
                        {!! Form::close() !!}
					
                    </div>
                </div>
            </div>
            </div>
                
        </div>
    </div>
@endsection

@section('script')
<script>

    
    /*$.validator.addMethod("uniqueMobile", function(value, element) {
         var isSuccess = false;
            $.ajax({
                type: "GET",
                url: '{{url('admin/mobileCheck')}}',
                data: "checkMobile="+value,
                async: false,
                //dataType:"html",
                success: function(msg)
                { 
                    //If username exists, set response to true
                    //response = (msg === 'true') ? true : false;
                    isSuccess = msg === "false" ?  false : true;
                    
                }
             });
            return isSuccess;
        },
        "Username is Already Taken"
    );*/
  
    
$('#newUser').validate({

            rules: {
                firstName:{
                    required : true,
                    minlength:2
                },
                lastName:{
                    required : true,
                    minlength:2
                },
                email:{
                    required : true,
                    email : true
                },

                mobile:{
                    required : true,
                    minlength:10,
                    uniqueMobile: true
                },

                password:{
                    required : true
                },

                password_confirmation:{
                    required : true
                   // equalTo: "#password"
                }
            },

            messages: {
                
                firstName :{
                    required : "Enter your First name",
                    minlength : 'First Name should be 2 digits'
                },
                lastName :{
                    required : "Enter your Last name",
                    minlength : 'Last Name should be 2 digits'
                },
                email :{
                    required : "Enter your email",
                    email : "Enter Valid email"
                },
                mobile :{
                    required : 'Enter your Mobile Number',
                    minlength : 'Mobile Number should be 10 digits'
                },                
                password :{
                    required : "Enter your Password",
                },                
                password_confirmation :{
                    required : "Please re-enter password",
                }
            }
            
           

        });
</script>
@endsection