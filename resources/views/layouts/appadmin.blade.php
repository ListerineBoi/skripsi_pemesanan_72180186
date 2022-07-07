<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amoora Admin</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<style>
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="lds-facebook"><div></div><div></div><div></div></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                <a href="{{route('homeadmin')}}"><img src="{{ asset('img/logoinverted.jpg') }}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-th-large"></i> <span>Amoora E-commerce</span></a>
                                <ul class="collapse">
                                    <li><a href="{{route('homeadmin')}}">Katalog</a></li>
                                    <li><a href="#" aria-expanded="true">Sampling</a>
                                        <ul class="collapse">
                                            <li><a href="{{route('viewslotsampling')}}">Slot Sampling</a></li>
                                            <li><a href="{{route('viewslistsampling')}}">List Sampling</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li><a href="#" aria-expanded="true">Produksi</a>
                                        <ul class="collapse">
                                            <li><a href="{{route('viewslotproduksi')}}">Slot Produksi</a></li>
                                            <li><a href="{{route('viewslistproduksi')}}">List Produksi</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li><a href="#" aria-expanded="true">Konsultasi & Livechat</a>
                                        <ul class="collapse">
                                            <li><a href="{{route('viewformtambahkonsul')}}">Set Konsul</a></li>
                                            <li><a href="/chat">Chat</a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </li>
                            <!-- //////////////// -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                
                    <!-- nav and search button -->
                    
                <div class="row justify-content-center">
                    <!-- nav and search button -->
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-sm-12 clearfix center-block">
                            <div class="logo">
                                <a href="{{route('homeadmin')}}"><img src="{{ asset('img/logoinverted.jpg') }}" alt="logo"></a>
                            </div>
                        </div>   
                    </div>
                </div>
                
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="{{ asset('images/author/avatar.png') }}" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::guard('admin')->user()->name }} <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('viewprofileadmin')}}">Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div id="app">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area" style="background-color:#9A7563;">
                
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- jquery latest version -->
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/disablefunc.js') }}"></script>
    <script src="{{ asset('js/fileupload.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('js/line-chart.js') }}"></script>
    <!-- all bar chart activation -->
    <script src="{{ asset('js/bar-chart.js') }}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('js/pie-chart.js') }}"></script>
    <!-- others plugins -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{asset('js/sum.js')}}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
