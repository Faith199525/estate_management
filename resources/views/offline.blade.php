<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">

    <title>Offline</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/images/site.webmanifest">
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
  </head>
  <body>
    <div class="wrapper" style="min-height:50vh">
        <nav class="navbar navbar-expand-md navbar-light text-white  fixed-top" style="background-color:#093463">
          <div class="container">
            <a class="navbar-brand" href="#"><img src="/main/app-assets/images/logo/blocVariantLogo2.png" width="100" alt="Logo"> </a>
            <h3 class="text-center">{{settings('APP_NAME', 'Bloc')}}</h3>
          </div>
        </nav>

        <div class="container">
            <div class="" style="margin-bottom:10em; margin-top:10em;">
                <div class="d-flex justify-content-center">
                    <div class=" text-sm-center">
                        <div class="center">
                            <img src="/images/no_network.png" height="150" alt="" srcset="">
                            <h3>No internet connection</h3>
                            <p>Make sure Wi-Fi or cellular network is turned on, then try again.</p>
                            <a href="" class="btn btn-success">Retry</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-sm">
                <div class="justify-content-center">
                  <div class="text-sm-center">
                    <h6>&copy; {{date('Y')}} <a href="https://synccentre.com">De Sync Centre Ltd.</a></h6>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </body>
  {{-- <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/images/sw.js").then(function(reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
   </script> --}}
</html>
