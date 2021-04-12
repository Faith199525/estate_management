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

    <link rel="shortcut icon" href="/main/app-assets/images/ico/blocLogo.png">

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
    <link rel="stylesheet" type="text/css" href="/main/app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/main/assets/css/style.css">
    <!-- END Custom CSS-->

  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page bg-blue">

    <div>
        @yield('content')
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="/main/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
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
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="/main/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/main/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
