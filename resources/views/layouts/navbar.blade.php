<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FIND PROPERTY</title>
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
        <!--croppie-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="{{ url('/')}}/img/logo2.png" type="image/x-icon">
        <link rel="icon" href="{{ url('/')}}/img/logo2.png" type="image/x-icon">

        <link rel="stylesheet" href="{{ url('/')}}/assets/css/normalize.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="{{ url('/')}}/css/animate.css">

        <link rel="stylesheet" href="{{ url('/')}}/css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ url('/')}}/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="{{ url('/')}}/css/magnific-popup.css">

        <link rel="stylesheet" href="{{ url('/')}}/css/flaticon.css">
        <link rel="stylesheet" href="{{ url('/')}}/css/style.css">


         <!-- datatables -->
        <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

          <!-- summernote -->
        <link rel="stylesheet" href="{{ url('/')}}/plugins/summernote/summernote-bs4.min.css">
        <!--file Input-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @yield('style')
    </head>
    <body>
        @include('inc.login')
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar" >
            <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/')}}/img/logo2.png" alt="" style="width: 15vw;"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
              </button>

              <div class="collapse navbar-collapse" id="ftco-nav">


                <ul class="navbar-nav ml-auto" data-widget="treeview">
                    <li class="nav-item menu-open"><a href="{{ url('/')}}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ url('/all-properties')}}" class="nav-link">Properties</a></li>
                    <li class="nav-item"><a href="{{ url('/contact-us')}}" class="nav-link">Contact</a></li>
                  @guest

                    <li class="nav-item">
                        {{-- <a href="#" class="nav-link " data-toggle="modal" data-target="#login">Login/Register</a> --}}
                        <a href="{{ route('login') }}" class="nav-link ">Login/Register</a>
                    </li>
                    @endguest
                @auth
                {{-- <li class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" id="navbarNotifLink" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell" aria-hidden="true"></i><span class="badge bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropleft" aria-labelledby="navbarNotifLink">
                        <h6 class="text-center"><strong>Notification</strong> </h6>
                        <hr>
                        <a href="#" class="dropdown-item mt-0 d-flex">
                            <img class="img-responsive " style="height:30px;!important"src="{{ asset('avatars/'.Auth::user()->avatar)}}" alt="">
                            <div class="align-items-end ml-1">
                                <p class=" my-0">Agent agent commented your property <p>
                                <span class="subheading my-0" style="color: rgba(0, 0, 0, 0.4);">4 days ago </span>
                            </div>
                            <hr>

                        </a>
                        <a href="#" class="dropdown-item mt-0 d-flex">
                            <img class="img-responsive " style="height:30px;!important"src="{{ asset('avatars/'.Auth::user()->avatar)}}" alt="">
                            <div class="align-items-end ml-1">
                                <p class=" my-0">Agent agent commented your property <p>
                                <span class="subheading my-0" style="color: rgba(0, 0, 0, 0.4);">4 days ago </span>
                            </div>
                            <hr>

                        </a>
                        <a href="#" class="dropdown-item mt-0 d-flex">
                            <img class="img-responsive " style="height:30px;!important"src="{{ asset('avatars/'.Auth::user()->avatar)}}" alt="">
                            <div class="align-items-end ml-1">
                                <p class=" my-0">Agent agent commented your property <p>
                                <span class="subheading my-0" style="color: rgba(0, 0, 0, 0.4);">4 days ago </span>
                            </div>
                            <hr>

                        </a>

                        <a href="#" class="dropdown-item text-center"><h6><strong>View All Notification</strong></h6></a>
                    </div>

                </li> --}}
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->fname }} {{ Auth::user()->lname }} <b class="caret"></b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if (Auth::user()->roles->role_type == 'Administrator')
                                <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>

                                {{-- <a class="dropdown-item" href="">Direct Messages</a> --}}
                            @else
                                <a class="dropdown-item" href="{{ url('/my-dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('myprofile.show', Auth::user()->id ) }}">Account Information</a>
                                <a class="dropdown-item" href="{{ url('/my-dashboard/properties')}}">Property Management</a>
                                <a class="dropdown-item" href="{{ route('favAge')}}">Favourites</a>
                                <a class="dropdown-item" href="{{ route('report')}}">Reported Property</a>

                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endauth
                </ul>

            </div>
          </nav>
        <!-- END nav -->

      @yield('content')

        <footer class="ftco-footer ftco-section">
          <div class="container">
            <div class="row mb-5">
              <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <img src="{{ url('/')}}/img/logo2.png" alt="" style="width: 40%" class="mb-2">
                  <p>Property searching makes it easy with FindProperty!</p>
                  <ul class="ftco-footer-social list-unstyled mt-5">
                    <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                    <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                  <h2 class="ftco-heading-2">Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}"><span class="fa fa-chevron-right mr-2"></span>HOME </a></li>
                    <li><a href="{{ url('/all-properties') }}"><span class="fa fa-chevron-right mr-2"></span>PROPERTIES</a></li>
                    <li><a href="{{ url('/contact-us')}}"><span class="fa fa-chevron-right mr-2"></span>CONTACT US</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                      <ul>
                        <li><span class="icon fa fa-map"></span><span class="text">Poblacion, Quezon, Bukidnon, PHILIPPINES</span></li>
                        <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+63 995 801 4272</span></a></li>
                        <li><a href="#"><span class="icon fa fa-envelope pr-4"></span><span class="text">info@yourdomain.com</span></a></li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">

                <p>Copyright &copy;2021 All rights reserved | FindProperty</p>
              </div>
            </div>
          </div>
        </footer>



      <!-- loader -->
      <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>





        <script src="{{ url('/')}}/js/jquery-migrate-3.0.1.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ url('/')}}/js/jquery.easing.1.3.js"></script>
        <script src="{{ url('/')}}/js/jquery.waypoints.min.js"></script>
        <script src="{{ url('/')}}/js/jquery.stellar.min.js"></script>

        <script src="{{ url('/')}}/js/owl.carousel.min.js"></script>
        <script src="{{ url('/')}}/js/jquery.magnific-popup.min.js"></script>
        <script src="{{ url('/')}}/js/jquery.animateNumber.min.js"></script>
        <script src="{{ url('/')}}/js/scrollax.min.js"></script>

        <script src="{{ url('/')}}/js/main.js"></script>

        <!-- Summernote -->
        <script src="{{ url('/')}}/plugins/summernote/summernote-bs4.min.js"></script>

        <!--file Input-->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>


        {{-- <script type="text/javascript" src="{{ url('/')}}/assets/js/lightslider.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
        {{-- <script src="{{ url('/')}}/assets/js/main.js"></script> --}}

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

        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

        <script type="text/javascript">
            $(function () {
                var url = window.location;

                $('ul.navbar-nav a').filter(function () {
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
