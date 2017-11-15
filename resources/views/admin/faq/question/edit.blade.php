@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Update Question</h3>
            <hr>
            <div class="grid_3 fulldiv">    
            <div class="col-lg-12">
                <div class="tab-content">
                    @if(Session::has('success'))
                    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> 
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('error')}} </div> 
                    @endif
                    <div class="tab-pane active" id="horizontal-form">
                        <form method="post" action="{{url('admin/faq/question/update')}}" class="form-horizontal" id="editQuestion">
                            {{csrf_field()}}
                            <input type="hidden" name="id" id="Question_id" value="{{$id}}">
                            
                            <div id="msgStatus"></div>

                            <div class="form-group">
                                <label for="category_id" class="col-sm-2 control-label">Faq Category</label>
                                <div class="col-sm-4"> 
                                    <select name="category_id" id="category_id" class="form-control1 select2">
                                        <option value="">Select Category</option>
                                        @foreach($faqs as $faq)
                                        <option value="{{$faq['id']}}" {{$faq['id']==$question['category_id'] ? 'selected' : ''}}>{{$faq['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="question" class="col-sm-2 control-label">Question</label>
                                <div class="col-sm-8">
                                    <input type="text" name="question" id="question" class="form-control1" value="{{$question['question']}}">
                                     @if ($errors->has('question'))
                                        <div class="error small">{{ $errors->first('question') }}</div>
                                     @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="answer" class="col-sm-2 control-label">Answer</label>
                                <div class="col-sm-8">
                                <textarea name="answer" id="answer">{{$question['answer']}}</textarea>
                                    @if ($errors->has('answer'))
                                        <div class="error">{{ $errors->first('answer') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role_id" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8"> 
                                    <select name="status" id="status" class="form-control1 select2">
                                        <option value="">Select status</option>
                                        <option value="1" {{$question['status']=='1' ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$question['status']=='0' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error small">{{ $errors->first('status') }}</div>
                                     @endif
                                </div>
                            </div>
                            
                            <div class="col-sm-8 col-sm-offset-2">
                                <input type="submit" name="submit" id="question" class="btn-success btn" value="Save Question">
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

    
$('#editQuestion').validate({

            rules: {
                category_id:{
                    required : true,
                },
                question:{
                    required : true,
                },
                answer:{
                    required : true,
                },

                status:{
                    required : true,
                },
            },

            messages: {
                
                category_id :{
                    required : "Select Category",
                },
                question :{
                    required : "Enter your Question",
                },
                answer :{
                    required : "Enter your Answer",
                },
                status :{
                    required : 'Select Status',
                },                
            }
            
           

        });
</script>
@endsection