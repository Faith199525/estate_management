<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{strtoupper(settings('APP_NAME', 'ERMS'))}} Resident Management Portal">
    <meta name="keywords" content="{{strtoupper(settings('APP_NAME', 'ERMS'))}} Resident Management Portal">
    <meta name="author" content="Sync Centre">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')

    {{-- <link rel="apple-touch-icon" sizes="60x60" href="/main/app-assets/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/main/app-assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/main/app-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/main/app-assets/images/ico/apple-icon-152.png"> --}}
    <link rel="shortcut icon" href="/main/app-assets/images/ico/blocLogo.png">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="/main/app-assets/images/ico/favicon.ico"> --}}
    {{-- <link rel="shortcut icon" type="image/png" href="/main/app-assets/images/ico/favicon-32.png"> --}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="/main/app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="/main/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="/main/app-assets/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/main/assets/css/style.css">
    <!-- END Custom CSS-->
    @yield('css')

  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-blue navbar-shadow">
      <div class="navbar-wrapper blue">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1 white"></i></a></li>
            <li class="nav-item"><a href="/" class="navbar-brand nav-link">
              <img alt="branding logo" src="/main/app-assets/images/logo/blocVariantLogo3.png" data-expand="/main/app-assets/images/logo/blocVariantLogo2.png" data-collapse="/main/app-assets/images/logo/blocMini.png" class="brand-logo"></a>
              {{--  <h3 style="color:white;">{{strtoupper(settings('APP_NAME', 'ERMS'))}}</h3>  --}}
              {{--  <img alt="branding logo" src="/main/app-assets/images/logo/blocCentreLogo.png"  style="width:10rem;" data-expand="/main/app-assets/images/logo/blocCentreLogo.png" data-collapse="/main/app-assets/images/logo/blocLogo.png" class="brand-logo"></a>  --}}
            </li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right white"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="/main/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name">{{ Auth::user()->name }}</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="/home" class="dropdown-item"><i class="icon-stack-2"></i> My Dashboard</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="icon-power3"></i> {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- main menu-->
    @include('superAdmin.snipets.side_nav')
    <!-- / main menu-->

    <div class="app-content content container-fluid" style="min-height:86vh">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->

        @include('snipets.alerts')

        @yield('content')

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; {{date('Y')}} <a href="https://synccentre.com" target="_blank" class="text-bold-800 grey darken-2">De  Sync Centre </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="/main/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script> --}}
    <script src="/main/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="/main/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="/main/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="/main/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="/main/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="/main/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="/main/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="/main/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    {{-- <script src="/main/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script> --}}
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="/main/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/main/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="/main/app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL JS-->

    @yield('scripts')

  </body>
</html>
