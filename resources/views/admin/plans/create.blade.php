@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">New Plan</h3>
            <hr>

        {!! Form::open(array('url' => 'admin/plans/','method' => 'post','class'=>'form-horizontal','id'=>'NewPlans')) !!}

        {{csrf_field()}}
            <div class="grid_3 fulldiv pd10 m0">
                <div class="row">
                    <div class="pull-right pd10"> 
                        <a href="{{ url('admin/plans') }}" class="btn  btn-danger min-btn"><i class="fa fa-times"></i>
                        <span>Close</span></a>
                    </div>
                    <div class="pull-right pd10"> 
                      <button type="submit" name="submit" value="save_close" class="btn  btn-primary min-btn" type="button"><i class="fa fa-times"></i> Save </button>
                    </div>
                </div>
            </div>
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
                            
                            <div id="msgStatus"></div>
                             <!-- <div class="form-group" style="display:none">
                                     {!! Form :: text('userType','3',['class'=>'form-control', 'id'=>'userType'])  !!}                                                              
                            </div> -->
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
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
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                <select name="status" id="status" class="form-control select2">
                                    <option value="">Select Status</option>
                                    <option value="1" {{old( 'status')=='1' ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{old( 'status')=='0' ? 'selected' : ''}}>In Active</option>
                                </select>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </div>
        {!! Form::close() !!}     
        </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">
    
$('#NewPlans').validate({
            rules: {
                title:{
                    required : true,
                    minlength:3
                },
                description:{
                    required : true,
                    minlength:3
                },
                status:{
                    required : true,
                },
            },
        });
</script>

@endsection