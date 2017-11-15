@extends('layouts.admin-layout')
@section('body')
<div id="page-wrapper">
    <div class="graphs">
        <div class="float-left pd10">
        <h3 class="blank1">Users</h3>
        </div>
        <div class="float-right pd10">
            <a href="{{ url('admin/user/create') }}" class="btn btn-primary" title="New USer">
             <i class="fa fa-user"></i> <span>New User</span>
            </a>
        </div>
        <hr>
        <div class="grid_3 fulldiv pd10 m0">
            <div class="row">
                <form method="post" action="{{url('admin/user')}}" id='menu' class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" name="search" value="search">
                    <div class="col-sm-2 grid_box1"> 
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control input-sm" placeholder="Name">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control input-sm" placeholder="Email">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control input-sm" placeholder="Mobile">
                    </div>
                    <div class="col-sm-2 grid_box1">
                        <select name="status" id="status" class="form-control select2">
                            <option value="">Select Status</option>
                            <option value="1" {{old( 'status')=='1' ? 'selected' : ''}}>Active</option>
                            <option value="0" {{old( 'status')=='0' ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-4 grid_box1">
                        <input type="submit" value="Search" class="btn btn-success min-btn">
                        <a href="{{ url('admin/user') }}" class="btn btn-success min-btn" title="Refresh">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </form>
            </div>
            @if ($errors->any())
                <div class="error small">
                    <span style="margin-right: 10px;">{{ $errors->first('name') }}</span>
                    <span style="margin-right: 10px;">{{ $errors->first('email') }}</span>
                    <span style="margin-right: 10px;">{{ $errors->first('mobile') }}</span>
                    <span>{{ $errors->first('status') }}</span>
                </div>
            @endif
        </div>
        <div class="clearfix"></div>
        <div class="xs tabls tab-content">
             @if(Session::has('success'))
                <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('success')}} </div> 
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('error')}} </div> 
                @endif
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h2>Users List</h2>
                    <div class="panel-ctrls"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
                </div> 
               
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
                            <?php $i = ($users->currentpage()-1)* $users->perpage() + 1; ?> @foreach($users as $user)
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><a href="{{url('admin/user/'.$user->id)}}" class="btn btn-xs btn-link">{{$user->first_name." ".$user->last_name}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile_number}}</td>
                                    <td><a onclick="return confirm('Do you Want to Change Status?');return false;" href="{{URL :: asset('admin/user/status/'.$user->id.'_'.$user->status)}}">{{($user->status=='1')?'Active' : 'Inactive'}}</a></td>
                                    <td>{{date('F d, Y', strtotime($user->created_at))}}</td>
                                    <td> <a href="{{URL :: asset('admin/user/'.$user->id)}}/edit" class="btn btn-success" title='edit'><i class="fa fa-edit"></i></a>
                                        <?php if(Auth::user()->role_id==1) { ?> <a onclick="return confirm('Do you Want to Delete User?');return false;" href="{{URL :: asset('admin/user/'.$user->id)}}/delete" class="btn btn-success" title='delete'><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                    </td>
                                </tr> @endforeach @else
                                <tr>
                                    <td><i>No User Found</i></td>
                                </tr> @endif </tbody>
                    </table>
                    <div class="col-sm-12 text-center">
                        {{$users->links()}}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop