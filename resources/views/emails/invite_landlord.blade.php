<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/bootstrap-extended.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/app.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/pages/invoice.css")}}">

</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <p>Hello,</p>

                    <p>You have been invited by {{settings('FULL_NAME', 'Your Estate')}} to create an account and manage your properties, tenants, dues and a lot more.</p>

                    <p>Getting started is very easy and you would be guided through the entire journey.
                    <br>
                    As a first step, you are required to register your account using this <a href="{{ route('accept', $invite->token) }}">unique link.</a> </p>

                    <p>Kindy <a href="{{ route('accept', $invite->token) }}">Click here</a> to activate!</p>

                    <footer>
                        <span>Cheers</span>
                        <br>
                        <span>{{settings('FULL_NAME','Your Estate')}}</span>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
