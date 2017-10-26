<!--

Author: W3layouts

Author URL: http://w3layouts.com

License: Creative Commons Attribution 3.0 Unported

License URL: http://creativecommons.org/licenses/by/3.0/

-->

  

<!DOCTYPE HTML>

<html>

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Panel | SWIFT</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Bootstrap Core CSS -->

        {!! Html::style('public/admin/css/bootstrap.min.css') !!}        

        <!-- Custom CSS -->

        {!! Html::style('public/admin/css/style.css') !!}

        <!-- Graph CSS -->

        {!! Html::style('public/admin/css/font-awesome.css') !!}

        <!-- jQuery -->

        <!-- lined-icons -->

        {!! Html::style('public/admin/css/icon-font.min.css') !!}

        <!-- //lined-icons -->

        <!-- chart -->

        {!! HTML::script('public/admin/js/Chart.js')!!}      

        <!-- //chart -->

        <!--animate-->

        {!! Html::style('public/admin/css/animate.css') !!}

        {!! HTML::script('public/admin/js/wow.min.js')!!}   

                <script>

                         new WOW().init();

                </script>

        <!--//end-animate-->





         <!-- Meters graphs -->

         {!! HTML::script('public/admin/js/jquery-1.10.2.min.js')!!}   

        <!-- Placed js at the end of the document so the pages load faster -->  

</head> 

<body class="sticky-header" >

    <section>
    <!-- left side start-->

        <div class="left-side sticky-left-side">



            <!--logo and iconic logo start-->

            <div class="logo">

                <h1><a href="{{ url('admin/dashboard') }}">Swift<span>Admin</span></a></h1>

            </div>

            <div class="logo-icon text-center">

                    <a href="{{ url('admin/dashboard') }}"><i class="lnr lnr-home"></i> </a>

            </div>



                <!--logo and iconic logo end-->

            <div class="left-side-inner">

                <!--sidebar nav start-->

                <ul class="nav nav-pills nav-stacked custom-nav">

                    <li class="active">

                        <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>

                    </li>

                    <li class="menu-list">

                        <a href="#"><i class="fa fa-user"></i>

                        <span>User</span></a>

                        <ul class="sub-menu-list">

                            <li><a href="{{ url('admin/users/create') }}">New User</a> </li>

                            <li><a href="{{ url('admin/userList') }}">User List</a></li>

                        </ul>

                    </li>

                    

                </ul>

                    <!--sidebar nav end-->

            </div>

        </div>

        <!-- left side end-->

        <!-- main content start-->

        <div class="main-content">

                <!-- header-starts -->

                <div class="header-section">



                <!--toggle button start-->

                <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>

                <!--toggle button end-->



                <!--notification menu start -->

                <div class="menu-right">

                    <div class="user-panel-top">  

                            <div class="profile_details">		

                                <ul>

                                    <li class="dropdown profile_details_drop">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                                        <div class="profile_img">	

                                            <span style="background:url(images/1.jpg) no-repeat center"> </span> 

                                             <div class="user-name">

                                                 

                                                    <p>Swift  <span>Admin</span></p>

                                             </div>

                                             <i class="lnr lnr-chevron-down"></i>

                                             <i class="lnr lnr-chevron-up"></i>

                                            <div class="clearfix"></div>	

                                        </div>	

                                        </a>

                                        <ul class="dropdown-menu drp-mnu">

<!--                                            <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 

                                            <li> <a href="#"><i class="fa fa-user"></i>Profile</a> </li> -->

                                            <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>
                                        </ul>

                                    </li>

                                    <div class="clearfix"> </div>

                                </ul>

                            </div>		



                            <div class="clearfix"></div>

                    </div>

                  </div>

                <!--notification menu end -->

                </div>

        <!-- //header-ends -->

    @yield('body')

 

 </div>

    <!--footer section start-->

        <footer>

           <p>Copyright � 2015 S4 Shipment Technologies Pvt. Ltd. | All Rights Reserved <a href="JavaScript:void(0);" target="_blank">Haultips.com</a></p>

        </footer>

    <!--footer section end-->



  <!-- main content end-->

   </section>

 

    {!! HTML::script('public/admin/js/jquery.nicescroll.js')!!} 

    {!! HTML::script('public/admin/js/scripts.js')!!} 

    {!! HTML::script('public/admin/js/bootstrap.min.js')!!}

     {!! Html::script('public/admin/js/jquery.validate.min.js') !!}

    {!! Html::script('public/admin/js/additional-methods.min.js') !!} 

    {!! Html::script('public/user/js/pusher.min.js') !!} 

   

    @yield('script')

 </body>

</html>