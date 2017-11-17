<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Meet up with your freind bu using MeetingAPP">
    <meta name="author" content="Ganza respice">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/admin-logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content=""/>
    <title>MeetingApp</title>
     
    <link href="{{ asset('/styles/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{ asset('/styles/css/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{ asset('/styles/css/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ asset('/styles/css/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('/styles/plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/styles/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('/styles/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/styles/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('/styles/css/colors/default.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/styles/css/font-awesome.min.css') }}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />


</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0"  style="padding-bottom:10px">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="#">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="{{ asset('/images/admin-logo.png') }}" style="margin-left:10%;width:70px" alt="home" class="dark-logo" />
                        <!--This is light logo icon--><img src="{{ asset('/images/admin-logo.png') }}" style="margin-left:10%;width:70px" alt="home" class="light-logo" />
                     </b>
                   
                     </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                @if (Auth::guest())
                         <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li> 
                        @else
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                    <li>
                        <a class="profile-pic"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <img src="{{ asset('/images/user.png') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @if (Auth::guest())
        
       
            <div class="row" style="margin-top:10%">
                <div  style="margin-left:0%" class="col-lg-12 col-lg-offset-6 col-md-12 col-md-offset-6 col-sm-12 col-xs-12">
                   
               <!-- /.col-lg-12 -->
            
               @yield('content')

                </div>
                <footer class="footer text-center"> 2017 &copy; Meeting up </footer>
            </div>    

        @else
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="/home" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li  style="padding: 70px 0 0;">
                        <a href="/meeting" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i>Meetings</a>
                    </li>
                    <!-- <li>
                        <a href="/agenda" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Agenda</a>
                    </li>
                    <li>
                        <a href="/issues" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i>Issues</a>
                    </li> -->
                    <li>
                        <a href="/members" class="waves-effect"><i class="fa fa-user fa-fw " aria-hidden="true"></i>Members</a>
                    </li>
                    <li>
                        <a href="/setting" class="waves-effect"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>My setting</a>
                    </li>
                

                </ul>
            
            </div>
        
        </div>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
     
    @yield('content')
      
        <!-- /.container-fluid -->
       
        <footer class="footer text-center"> 2017 &copy; Meeting up </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->

    @endif
</div>


</div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->

    <!-- Scripts -->
    <script src="{{ asset('styles/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/styles/js/bootstrap.min.js') }}"></script>
    
    <!-- Menu Plugin JavaScript -->
    <script src="{{ asset('/styles/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ asset('/styles/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('/styles/js/waves.js') }}"></script>
    <!--Counter js -->
    <script src="{{ asset('/styles/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('/styles/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
    <!-- chartist chart -->
    <script src="{{ asset('/styles/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('/styles/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="{{ asset('/styles/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/styles/js/custom.min.js') }}"></script>
    <script src="{{ asset('/styles/js/dashboard1.js') }}"></script>
    <script src="{{ asset('/styles/js/colResizable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/styles/js/FileSaver.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/styles/js/jquery.wordexport.js') }}"></script>
    <script src="{{ asset('/styles/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  
</body>

</html>