@extends('layouts.admin-layout')
@section('body')
<div id="page-wrapper">
    <div class="graphs">
          <h3 class="blank1">Plans</h3>
        <hr>

        <div class="grid_3 fulldiv pd10 m0">
            <div class="row">
                <form method="POST" action="{{url('admin/plans/index')}}" id='' class="form-horizontal">
                    {{csrf_field()}}
                    <div class="col-sm-2 grid_box1"> 
                        <input type="text" name="name" value="{{ old('title') }}" class="form-control1 input-sm" placeholder="Plan Name">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <select name="status" id="status" class="form-control1 select2">
                            <option value="">Select Status</option>
                            <option value="1" {{old( 'status')=='1' ? 'selected' : ''}}>Active</option>
                            <option value="0" {{old( 'status')=='0' ? 'selected' : ''}}>In Active</option>
                        </select>
                    </div>
                    <div class="col-sm-4 grid_box1">
                        <input type="submit" value="Search" class="btn btn-success min-btn">
                          <a href="{{ url('admin/plans') }}" class="btn btn-success min-btn" title="Refresh">
                            <i class="fa fa-refresh"></i> <span>Reset</span>
                        </a>
                    </div>
                    <div class="col-sm-2 col-sm-offset-2"> 
                            <a href="{{ url('admin/plans/create') }}" class="btn btn-primary min-btn" title="Add New Plan">
                            <i class="fa fa-plus"></i>
                            <span>New Plans</span>
                            </a>
                    </div>
                   
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="xs tabls tab-content">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h2>Plans List</h2>
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
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(count($plans)>0)
                            <?php if(isset($page)) $i=$page['from']; else $i=1; ?> @foreach($plans as $plan)
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><a href="{{url('admin/Plans/'.$plan->id)}}" class="btn btn-xs btn-link">{{$plan->title}}</a></td>
                                    <td><a onclick="return confirm('Do you Want to Change Status?');return false;" href="{{URL :: asset('admin/plans/status/'.$plan->id.'_'.$plan->status)}}">{{($plan->status=='1')?'Active' : 'Inactive'}}</a></td>
                                    <td>{{date('F d, Y', strtotime($plan->created_at))}}</td>
                                    <td> <a href="{{URL :: asset('admin/plans/'.$plan->id)}}" class="btn btn-success" title='edit'><i class="fa fa-edit"></i></a>
                                        <?php if(Auth::user()) { ?> <a onclick="return confirm('Do you Want to Delete User?');return false;" href="{{URL :: asset('admin/plans/'.$plan->id)}}/delete" class="btn btn-success" title='delete'><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                    </td>
                                </tr> @endforeach @else
                                <tr>
                                    <td><i>No Plans</i></td>
                                </tr> @endif 
                        </tbody>
                    </table>
                    <?php  //echo $users->render();  ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop