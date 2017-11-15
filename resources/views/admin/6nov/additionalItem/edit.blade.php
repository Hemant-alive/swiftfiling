@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Update Item</h3>
            <hr>
        

          {!! Form::open(array('url' => 'admin/additional-item/'.$id, 'method' => 'patch','class'=>'form-horizontal','id' =>'updateItem')) !!}
           
             {{csrf_field()}}
             
            <input type="hidden" name="id" value="{{$id}}">
            
            <div class="grid_3 fulldiv pd10 m0">
                <div class="row">
                    <div class="pull-right pd10"> 
                        <a href="{{ url('admin/additional-item') }}" class="btn  btn-danger min-btn"><i class="fa fa-times"></i>
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
                            <div class="form-group">
                                <label for="plan_id" class="col-sm-2 control-label">Plan</label>
                                <div class="col-sm-8">
                                <select name="plan_id" id="plan_id" class="form-control1 select2">
                                    <option value="">Select Plan</option>
                                    @for($i=0;$i<count($plans);$i++)

                                    <option value="{!! $plans[$i]->id !!} " {{$plans[$i]->id==$items->plan_id ? 'selected' : ''}}>{!! $plans[$i]->title !!}</option>

                                    @endfor
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="plan_id" class="col-sm-2 control-label">Package</label>
                                <div class="col-sm-8">
                                <select name="package_id" id="package_id" class="form-control1 select2">
                                    <option value="">Select Package</option>
                                    @for($i=0;$i<count($package);$i++)

                                    <option value="{!! $package[$i]->id !!}" {{$package[$i]->id==$items->package_id ? 'selected' : ''}}>{!! $package[$i]->title !!}</option>

                                    @endfor
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" id="title" class="form-control1" value="{{$items->title}}">
                                     @if ($errors->has('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                     @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-8">
                                    <input type="text" name="price" id="price" class="form-control1" value="{{$items->price}}">
                                     @if ($errors->has('price'))
                                        <div class="error">{{ $errors->first('price') }}</div>
                                     @endif
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-8">
                                    <select name="options" id="options" class="form-control1 select2">
                                        <option value="">Select Category</option>
                                        <option value="0" {{$items->options == 0 ? 'selected' : ''}}>Normal</option>
                                        <option value="1" {{$items->options == 1 ? 'selected' : ''}}>Expeditions</option>
                                        <option value="2" {{$items->options == 2 ? 'selected' : ''}}>Shiping</option>
                                    </select>
                                </div>                               
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-8">
                                <textarea name="description" id="description">{{$items->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="error">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Notes</label>
                                <div class="col-sm-8">
                                <textarea name="notes" id="notes" rows="2" cols="2">{{$items->notes}}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="error">{{ $errors->first('notes') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                <select name="status" id="status" class="form-control1 select2">
                                    <option value="">Select Status</option>
                                    <option value="1" {{$items->status =='1' ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$items->status =='0' ? 'selected' : ''}}>In Active</option>
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
    
$('#updateItem').validate({
            rules: {
                plan_id:{
                    required : true,
                },
                package_id:{
                    required : true,
                },
                description:{
                    required : true,
                    minlength:10
                },
                status:{
                    required : true,
                },
                options:{
                    required : true,
                },
                title:{
                    required : true,
                    minlength:3
                },
            },
        });
</script>
@endsection