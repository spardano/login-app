<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- base:css -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">    
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('template') }}/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('template') }}/images/favicon.png" />
    @stack('css')
  </head>

  <body>
      <div class=" container-scroller">
        @include('partials._navbar')
        <div class="container-fluid page-body-wrapper">
          @include('partials._sidebar')
          <div class="main-panel">
            <div class="content-wrapper">
              @yield('content')
            </div>
          </div> 
        </div> 
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- base:js -->
    <script src="{{ asset('template') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('template') }}/js/off-canvas.js"></script>
    <script src="{{ asset('template') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('template') }}/js/template.js"></script>
    <script src="{{ asset('template') }}/js/settings.js"></script>
    <script src="{{ asset('template') }}/js/todolist.js"></script>
    


<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>

<script src="plugins/chart.js/Chart.min.js"></script>

<script src="dist/js/demo.js"></script>

<script src="dist/js/pages/dashboard2.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
    @stack('js')
  </body>
</html>