<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
@yield('css')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
@include('layouts.partials.header')
  
      
  <!-- sidebar -->
  @include('layouts.partials.sidebar')
  <!---->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
      @yield('main')  
    <!-- /.content -->
  
  
  </div>
  @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('layouts.partials.script')
@yield('js')
</body>
</html>
