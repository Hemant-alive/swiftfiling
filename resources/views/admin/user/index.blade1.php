@extends('layouts.admin-layout')
@section('body')
<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Users</h3>
        <hr>
        <div class="grid_3 fulldiv pd10 m0">
            <div class="row">
                <form method="get" action="{{url('admin/userList')}}" id='menu' class="form-horizontal">
                    {{csrf_field()}}
                    <div class="col-sm-2 grid_box1"> 
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control1 input-sm" placeholder="Name">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control1 input-sm" placeholder="Email">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control1 input-sm" placeholder="Mobile">
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
                        <a href="{{ url('admin/userList') }}" class="btn btn-success min-btn" title="Refresh">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="xs tabls tab-content">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h2>Users List</h2>
                    <div class="panel-ctrls"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
                </div> @if(Session::has('success'))
                <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> @endif
                <div class="panel-body no-padding" style="display: block;">
                    <table class="table table-striped">
                        <thead>
                            <tr class="warning">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Registered Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> @if(count($users)>0)
                            <?php if(isset($page)) $i=$page['from']; else $i=1; ?> @foreach($users as $user)
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><a href="{{url('admin/users/'.$user->id)}}" class="btn btn-xs btn-link">{{$user->first_name." ".$user->last_name}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile_number}}</td>
                                    <td><a onclick="return confirm('Do you Want to Change Status?');return false;" href="{{URL :: asset('admin/user/status/'.$user->id.'_'.$user->status)}}">{{($user->status=='1')?'Active' : 'Inactive'}}</a></td>
                                    <td>{{date('F d, Y', strtotime($user->created_at))}}</td>
                                    <td> <a href="{{URL :: asset('admin/users/'.$user->id)}}/edit" class="btn btn-success" title='edit'><i class="fa fa-edit"></i></a>
                                        <?php if(Auth::user()->user_type_id==1) { ?> <a onclick="return confirm('Do you Want to Delete User?');return false;" href="{{URL :: asset('admin/users/'.$user->id)}}/delete" class="btn btn-success" title='delete'><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                    </td>
                                </tr> @endforeach @else
                                <tr>
                                    <td><i>No User Found</i></td>
                                </tr> @endif </tbody>
                    </table>
                    <?php  //echo $users->render();  ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop