@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Update User</h3>
            <hr>
            <div class="grid_3 fulldiv">    
            <div class="col-lg-7">
                <div class="tab-content">
                   <!-- msssssg -->
                   @if(Session::has('success'))
                    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> 
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('error')}} </div> 
                    @endif
                    <div class="tab-pane active" id="horizontal-form">
                        <form method="post" action="{{url('admin/update')}}" class="form-horizontal" id="editUser">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$id}}">
                        
                            <div id="msgStatus"></div>
                             
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="firstName" name="firstName" value="{{$user->first_name}}">
                                    @if ($errors->has('firstName'))
                                        <div class="error">{{ $errors->first('firstName') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="lastName" name="lastName" value="{{$user->last_name}}">
                                    @if ($errors->has('lastName'))
                                        <div class="error">{{ $errors->first('lastName') }}</div>
                                    @endif
                                </div>                                
                            </div>                           
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="mobile" name="mobile" value="{{$user->mobile_number}}">
                                    @if ($errors->has('mobile'))
                                        <div class="error">{{ $errors->first('mobile') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="email" name="email" value="{{$user->email}}">
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2">
                                <button type="submit" class="btn-success btn" id="user">Update User</button>
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
                    minlength:10
                },

                password:{
                    required : true
                },

                cpassword:{
                    required : true
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
                cpassword :{
                    required : "Enter your Confirm Password",
                }
            }
            
           

        });
</script>
@endsection