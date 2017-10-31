@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">New Plan</h3>
            <hr>
        <form method="post" action="{{url('admin/plans')}}" class="form-horizontal" id="NewPlans">
        {{csrf_field()}}
            <div class="grid_3 fulldiv pd10 m0">
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-8"> 
                        <button type="submit" name="submit" value="save_close" class="btn  btn-primary min-btn" type="button"><i class="fa fa-times"></i> Save </button>

                    </div>
                    <div class="col-sm-2"> 
                        <button type="submit" name="submit" value="save_new" class="btn  btn-primary min-btn" type="button"><i class="fa fa-plus"></i> Save & Close </button>
                    </div>
                </div>
            </div>
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
                            
                            <div id="msgStatus"></div>
                             <!-- <div class="form-group" style="display:none">
                                     {!! Form :: text('userType','3',['class'=>'form-control1', 'id'=>'userType'])  !!}                                                              
                            </div> -->
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" id="title" class="form-control1" value="{{old('title')}}">
                                     @if ($errors->has('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                     @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-8">
                                <textarea name="description" id="description">{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="error">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </div>
        </form>         
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
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