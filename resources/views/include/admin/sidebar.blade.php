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

            <li class="{{  Request::segment(2)=== 'dashboard'?'active':''}}">
                <a href="{{ Request::segment(2) }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-list-s {{ Request::segment(2) === 'user'?'active':''}}">
                <a href="{{ url('admin/user') }}"><i class="fa fa-user"></i>
                <span>User</span></a>
            </li>
           <li class="menu-list-s {{ Request::segment(2) === 'plans'?'active':''}}">
                <a href="{{ url('admin/plans') }}"><i class="fa fa-tasks"></i>
                <span>Plans</span></a>
            </li>
            <li class="menu-list-s {{ Request::segment(2) === 'package'?'active':''}}">
                <a href="{{ url('admin/package') }}"><i class="fa fa-tasks"></i>
                <span>Package</span></a>
            </li>
             <li class="menu-list-s {{ Request::segment(2) === 'additional-item'?'active':''}}">
                <a href="{{ url('admin/additional-item') }}"><i class="fa fa-tasks"></i>
                <span>Additional Items</span></a>
            </li>
            <li class="menu-list {{ Request::segment(2) === 'faq'?'active':''}}">

                        <a href="#"><i class="fa fa-question-circle"></i>
                        <span>Faq</span></a>

                        <ul class="sub-menu-list">

                            <li class="{{ Request::segment(3) === 'category'?'active':''}}"><a href="{{ url('admin/faq/category') }}">Faq Category</a> </li>

                            <li class="{{ Request::segment(3) === 'question'?'active':''}}"><a href="{{ url('admin/faq/question') }}">Faq Questions</a></li>

                        </ul>

            </li>
        </ul>
    </div>

</div>
