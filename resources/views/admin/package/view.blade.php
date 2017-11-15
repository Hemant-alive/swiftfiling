@extends('layouts.admin-layout')
@section('title')
    Admin Panel | Haultips
@endsection

@section('body')
    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Update Package</h3>
            <hr>
        

          {!! Form::open(array('url' => 'admin/package/'.$id, 'method' => 'patch','class'=>'form-horizontal','id' =>'updatePackage')) !!}


            <div class="grid_3 fulldiv pd10 m0">
                <div class="row">
                    <div class="pull-right pd10"> 
                        <a href="{{ url('admin/package') }}" class="btn  btn-danger min-btn"><i class="fa fa-times"></i>
                        <span>Close</span></a>
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
                                       {!! $plans->title !!} 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-8">
                                   {!! $package->title !!}
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-8">
                                    {{ $package->price }}
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Start Date</label>
                               <div class="col-sm-8">
                                    {{ $package->start_date }}
                                </div>                                 
                            </div>
                             <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">End Date</label>
                               <div class="col-sm-8">
                                    {{ $package->end_date }}
                                </div>                                 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-8">
                                {!! $package->description !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                {{ $package->status =='1' ? 'Active' : 'In-active' }}
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
