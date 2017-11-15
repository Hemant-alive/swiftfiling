<!DOCTYPE HTML>
<html>
    <head>
        @include('include.admin.head')
    </head> 

<body class="sticky-header" >
    <section>
        <!-- left side start-->
        @include('include.admin.sidebar')
        <!-- left side end-->

        <!-- main content start-->

        <div class="main-content">
            <!-- header-starts -->
            @include('include.admin.header')
            <!-- //header-ends -->
            <div style="margin-top:20px;"></div>
             <!-- body-starts -->
            @yield('body')
            <!-- //body-ends -->

        </div>

   </section>
    <!-- footer start-->
    @include('include.admin.footer')
     <!-- //footer end-->

    @yield('script')

 </body>

</html>