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
                    <p>Hi,</p>

                    <p>{{ $messageObj->content }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

