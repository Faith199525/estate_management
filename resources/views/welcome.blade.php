<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">

    <title>{{strtoupper(settings('APP_NAME', 'ERMS'))}} - Resident Management Portal</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <meta name="msapplication-TileColor" content="#2575fc">
    <meta name="msapplication-config" content="/images/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{strtoupper(settings('APP_NAME', 'ERMS'))}} Resident Management Portal">
    <meta name="keywords" content="{{strtoupper(settings('APP_NAME', 'ERMS'))}} Resident Management Portal">
    <link href="/landing/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600%7COpen+Sans:400%7CVarela+Round" rel="stylesheet">
    <link href="/landing/css/style.css" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <nav class="navbar navbar-expand-md navbar-light nav-white bg-light fixed-top">
          <div class="container">
            <a class="navbar-brand" href="#"><img src="/main/app-assets/images/logo/blocVariantLogo2.png" width="100" alt="Logo"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto navbar-right">
                    @auth
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
              </ul>
            </div>
          </div>
        </nav>
      </div>


      <div id="main" class="main">
        <div class=" home-3">
          <div class="container">
            <div class="hero-inner">
              <div class="intro-block wow fadeInLeft">
                <h1 style="font-size:2.8em; margin-bottom:0.5em;">{{strtoupper(settings('APP_NAME', 'ERMS'))}}</h1>
                <h1>Resident Management Portal</h1>
                <p>Best in class solution to manage all that relates to you including dues, biodata, tenants, property, apartments among others.</p>
                <a href="{{ route('login') }}" class="btn btn-action btn-edge wow fadeInLeft" data-wow-delay="0.2s">Login to Portal</a>
              </div>
              <div class="hero-img wow fadeInUp" style="">
                <img src="/images/payment.png" alt="Hero Image">
              </div>
            </div>
          </div>
        </div>

        <div class="footer-sm">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <a class="footer-logo" href="#">Bloc Centre</a>
              </div>
              <div class="col-md-4">
                <h6>&copy; {{date('Y')}} <a href="https://synccentre.com">De Sync Centre Ltd.</a></h6>
              </div>
              <div class="col-md-4">
                <ul>
                  <li><a href="#">Facebook</a></li>
                  <li><a href="#">Twitter</a></li>
                  <li><a href="#">Linkedin</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
  </body>
  <!-- Jquery and Js Plugins -->
  {{-- <script src="/landing/js/jquery-2.1.1.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
  <script src="/landing/js/popper.min.js"></script>
  <script src="/landing/js/bootstrap.min.js"></script>
  <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function(reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
   </script>
</html>
