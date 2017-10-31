<div class="left-side sticky-left-side">
    <!--logo and iconic logo start-->
    <div class="logo">
        <h1><a href="{{ url('admin/dashboard') }}">Swift<span>Admin</span></a></h1>
    </div>

    <div class="logo-icon text-center">
         <a href="{{ url('admin/dashboard') }}"><i class="lnr lnr-home"></i> </a>
    </div>

    <div class="left-side-inner">
        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">

            <li class="active">
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-list-s">
                <a href="{{ url('admin/userList') }}"><i class="fa fa-user"></i>
                <span>User</span></a>
                <!-- <ul class="sub-menu-list">
                    <li><a href="{{ url('admin/users/create') }}">New User</a> </li>
                    <li><a href="{{ url('admin/userList') }}">User List</a></li>
                </ul> -->
            </li>
            <li class="menu-list-s">
                <a href="{{ url('admin/plans') }}"><i class="fa fa-tasks"></i>
                <span>Plans</span></a>
            </li>
            <li class="menu-list-s">
                <a href="{{ url('admin/package') }}"><i class="fa fa-tasks"></i>
                <span>Package</span></a>
            </li>
        </ul>
    </div>

</div>
