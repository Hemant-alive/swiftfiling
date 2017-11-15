@extends('layouts.admin-layout')
@section('body')
<div id="page-wrapper">
    <div class="graphs">
          <h3 class="blank1">packages</h3>
        <hr>

        <div class="grid_3 fulldiv pd10 m0">
            <div class="row">

                     <form method="POST" action="{{url('admin/package/index')}}"  class="form-horizontal">

                    {{csrf_field()}}

                    <div class="col-sm-2 grid_box1"> 
                         <input type="hidden" name="search_filter" value="1">
                        <input type="text" name="name" value="{{Session::has('search_title')? Session::get('search_title') : old('title')}}" class="form-control input-sm" placeholder="Package Name">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <select name="status" id="status" class="form-control select2">
                            <option value="">Select Status</option>
                            <option value="1" {{Session::get('search_status')=='1' ? 'selected' : ''}}>Active</option>
                            <option value="0" {{Session::get( 'search_status')=='0' ? 'selected' : ''}}>In Active</option>
                        </select>
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <select name="plan_id" id="plan_id" class="form-control select2">
                            <option value="">Select Plan</option>
                            @for($i=0;$i<count($plans);$i++)

                            <option value="{!! $plans[$i]->id !!}" {{Session::get('search_plan') == $plans[$i]->id ? 'selected' : ''}}>{!! $plans[$i]->title !!}</option>

                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-4 grid_box1">
                        <input type="submit" value="Search" class="btn btn-success min-btn">
                          <a href="{{ url('admin/package') }}" class="btn btn-success min-btn" title="Refresh">
                            <i class="fa fa-refresh"></i> <span>Reset</span>
                        </a>
                    </div>
                    <div class="col-sm-2"> 
                            <a href="{{ url('admin/package/create') }}" class="btn btn-primary min-btn" title="Add New Plan">
                            <i class="fa fa-plus"></i>
                            <span>New package</span>
                            </a>
                    </div>
                   
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="xs tabls tab-content">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h2>Package List</h2>
                    <div class="panel-ctrls"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
                </div> 
                @if(Session::has('success'))
                <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> 
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('error')}} </div> 
                @endif
                <div class="panel-body no-padding" style="display: block;">
                    <table class="table table-striped">
                        <thead>
                            <tr class="warning">
                                <th>#</th>
                                <th>Name</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(count($packages)>0)
                            <?php if(isset($page)) $i=$page['from']; else $i=1; ?> @foreach($packages as $package)
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><a href="{{url('admin/package/'.$package->id)}}" class="btn btn-xs btn-link">{{$package->title}}</a></td>

                                    <td>{{$package->plan_name}}</td>

                                    <td><a onclick="return confirm('Do you Want to Change Status?');return false;" href="{{URL :: asset('admin/package/status/'.$package->id.'_'.$package->status)}}">{!! ($package->status=='1')?'<i class="fa fa-toggle-on" aria-hidden="true"></i><span class="success">active</span>' : '<i class="fa fa-toggle-on" aria-hidden="true"></i><span class="text-danger">Inactive</span>'!!}</a></td>

                                    <td>{{date('F d, Y', strtotime($package->created_at))}}</td>


                                    <td> <a href="{{URL :: asset('admin/package/'.$package->id.'/edit')}}" class="btn btn-success" title='edit'><i class="fa fa-edit"></i></a>
                                        <?php if(Auth::user()) { ?> <a onclick="return confirm('Do you Want to Delete User?');return false;" href="{{URL :: asset('admin/package/'.$package->id)}}/delete" class="btn btn-success" title='delete'><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                    </td>
                                </tr> @endforeach @else
                                <tr>
                                    <td><i>No Package</i></td>
                                </tr> @endif 
                        </tbody>
                    </table>

                    <div class="text-center">{{ $packages->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop