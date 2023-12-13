<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FindProperty </title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- croppie -->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{ url('/')}}/plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- iCheck -->
   <link rel="stylesheet" href="{{ url('/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- favicon -->
    <link rel="icon" href="{{ url('/')}}/img/logo2.png">

   <!-- Theme style -->
   <link rel="stylesheet" href="{{ url('/')}}/dist/css/adminlte.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{ url('/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

   <!-- summernote -->
   <link rel="stylesheet" href="{{ url('/')}}/plugins/summernote/summernote-bs4.min.css">
   <!-- datatables -->
   <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  {{-- fonts --}}
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('style')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/dashboard') }}" class="brand-link text-center">
            <img src="{{ url('/')}}/img/logo.png" width="60%">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt="user-avatar" class="img-circle elevation-2">
                </div>
                <div class="info">
                    <a href="{{ route('admin-profile.show', Auth::user()->id ) }}" class="d-block">
                        <p>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</p>
                    </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>User Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('all-properties.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>Properties</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('agencies')}}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Clients</p>
                        </a>
                        {{-- <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Overall Clients</p>
                                </a>
                                </li>
                          <li class="nav-item">
                            <a href="{{ route('agencies.private')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Private</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Agents</p>
                            </a>
                          </li>
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('test')}}" class="nav-link">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>Testimonial</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('rep') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p>Reports </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{ __('Logout') }} </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
    </aside>
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">Find Property</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{ url('/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- overlayScrollbars -->
<script src="{{ url('/')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/')}}/dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>


<script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('/')}}/plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
    $(function () {
        var url = window.location;
        // for single sidebar menu
        $('ul.nav-sidebar a').filter(function () {
            return this.href == url;
        }).addClass('active');

        // for sidebar menu and treeview
        $('ul.nav-treeview a').filter(function () {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview")
            .css({'display': 'block'})
            .addClass('menu-open').prev('a')
            .addClass('active');
    });
</script>


@yield('script')

</body>
</html>
