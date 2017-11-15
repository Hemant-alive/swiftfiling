
<!DOCTYPE html>
<html lang="en">
  <head>
     @include('include.site.head')
  </head>

  <body>
  <main>
    
         @include('include.site.header')
   
    
   
     @yield('body')
     
       <!-- footer start-->
    @include('include.site.footer')
     <!-- //footer end-->
  </main>
    


      


  
@yield('script')

    
  </body>
</html>
