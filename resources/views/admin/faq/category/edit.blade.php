@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Update Faq Category</h3>
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
                        <form method="post" action="{{url('admin/faq/category/update')}}" class="form-horizontal" id="editFaq">
                            {{csrf_field()}}
                            <input type="hidden" name="id" id="faq_id" value="{{$id}}">
                        
                            <div id="msgStatus"></div>

                             
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Faq Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="title" name="title" value="{{$faq->title}}">
                                    @if ($errors->has('title'))
                                        <div class="error small">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8"> 
                                    <select name="status" id="status" class="form-control1 select2">
                                        <option value="">Select status</option>
                                        <option value="1" {{ $faq->status == '1' ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ $faq->status == '0' ? 'selected' : ''}}>Inactive</option>
                                    </select>
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
 $('#editFaq').validate({

            rules: {
                title:{
                    required : true,
                    minlength:2
                },
                status:{
                    required : true,
                },
            },

            messages: {
                
                title :{
                    required : "Enter faq title",
                    minlength : 'Title should be at least 2 character'
                },
                status :{
                    required : "Select status",
                }
            }

        });
</script>
@endsection