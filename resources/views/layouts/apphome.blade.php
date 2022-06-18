<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amoora Couture</title>
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

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container" style="padding-left: 0px;">
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area" style="background-color:#9A7563;">
                <div class="row justify-content-center">
                    <!-- nav and search button -->
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-sm-12 clearfix center-block">
                            <div class="logo">
                                <a href="/"><img src="{{ asset('img/logoinverted.jpg') }}" alt="logo"></a>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center py-3">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">KATALOG</h4>
                            
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="pull-right">
                        @guest('web')
                            @guest('admin')
                                @if (Route::has('login'))
                                        <a class="btn btn-success" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                                @if (Route::has('register'))
                                        <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                                @else
                            @endguest
                        @endguest
                        @if(Auth::guard('admin')->check())
                        <a class="btn btn-success" href="{{ route('homeadmin') }}">Home</a>
                        @elseif(Auth::guard('web')->check())
                        <a class="btn btn-success" href="{{ route('home') }}">Home</a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                @yield('content')
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
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
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
