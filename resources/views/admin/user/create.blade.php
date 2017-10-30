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
                    @if(Session::has('success'))
                    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> 
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('error')}} </div> 
                    @endif
                    <div class="tab-pane active" id="horizontal-form">
                        <form method="post" action="{{url('admin/store')}}" class="form-horizontal" id="newUser">
                            {{csrf_field()}}
                            
                            <div id="msgStatus"></div>
                             <!-- <div class="form-group" style="display:none">
                                     {!! Form :: text('userType','3',['class'=>'form-control1', 'id'=>'userType'])  !!}                                                              
                            </div> -->
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="firstName" id="firstName" class="form-control1" value="{{old('firsName')}}">
                                     @if ($errors->has('firstName'))
                                        <div class="error">{{ $errors->first('firstName') }}</div>
                                     @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="lastName" id="lastName" class="form-control1" value="{{old('lastName')}}">
                                    @if ($errors->has('lastName'))
                                        <div class="error">{{ $errors->first('lastName') }}</div>
                                    @endif
                                </div>                                
                            </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-8">
                                    <input type="text" name="mobile" id="mobile" class="form-control1" value="{{old('mobile')}}">
                                    @if ($errors->has('mobile'))
                                        <div class="error">{{ $errors->first('mobile') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
				                <label class="col-sm-2 control-label">Email</label>
				                <div class="col-sm-8">
                                    <input type="text" name="email" id="email" class="form-control1" value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
				                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" id="password" class="form-control1" value="">
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control1" value="">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input type="submit" name="submit" id="user" class="btn-success btn" value="Save Usser">
                            </div>
                        </form>
					
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