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