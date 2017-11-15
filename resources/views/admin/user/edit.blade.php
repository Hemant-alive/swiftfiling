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
                            <input type="hidden" name="id" id="user_id" value="{{$id}}">
                        
                            <div id="msgStatus"></div>

                            <div class="form-group">
                                <label for="role_id" class="col-sm-2 control-label">User Role</label>
                                <div class="col-sm-8"> 
                                    <select name="role_id" id="role_id" class="form-control select2">
                                        <option value="">Select role</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{ $user->role_id == $role->id ? 'selected' : ''}}>{{$role->role}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{$user->first_name}}">
                                    @if ($errors->has('firstName'))
                                        <div class="error small">{{ $errors->first('firstName') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{$user->last_name}}">
                                    @if ($errors->has('lastName'))
                                        <div class="error small">{{ $errors->first('lastName') }}</div>
                                    @endif
                                </div>                                
                            </div>                           
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-8">
                                    <input type="text" maxlength="10" class="form-control" id="mobile" name="mobile" value="{{$user->mobile_number}}">
                                    @if ($errors->has('mobile'))
                                        <div class="error small">{{ $errors->first('mobile') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                                    @if ($errors->has('email'))
                                        <div class="error small">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2">
                                <button style="padding: 8px;margin-right: 5px;" class="btn btn-primary"  onclick="history.back()">
                                    <i class="fa fa-toggle-left"></i> <span>Back</span>
                                </button>
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
     $.validator.addMethod("uniqueMobile", function(value, element) {
         var isSuccess = false;
         var user_id = $('#user_id').val();
            $.ajax({
                type: "POST",
                url: '{{url('admin/mobilecheck')}}',
                data: {"_token": "{{ csrf_token() }}","contact": value, "user_id": user_id},
                async: false,
                //dataType:"html",
                success: function(msg)
                { 
                    //If username exists, set response to true
                    isSuccess = msg === 'true' ? true : false;
                }
             });
            return isSuccess;
        },
        "Mobile number is already registered"
    );
$('#editUser').validate({

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
                }
            }
            
           

        });
</script>
@endsection