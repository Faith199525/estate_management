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
    {{-- <section class="card" style="border: #2196F3 0.1em solid; margin: 2em;"> --}}
    <section class="card" style="margin:1em">
        <div id="invoice-template" class="card-block">

            <h3>Thank you {{ucwords($payment->user->name)}},</h3>

            <p>Your payment has been received.</p>
            <h4>Summary</h4>
            <div id="invoice-items-details" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-sm-12">
                        <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Due Type</th> --}}
                            <th class="text-xs-right">Due Amount(₦)</th>
                            <th class="text-xs-right">Quantity / Amount Paid(₦)</th>
                            <th class="text-xs-right">Total (₦)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (json_decode($payment->dues_paid) as $key => $due)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>
                                    <p>{{$due->name}}</p>
                                </td>
                                {{-- <td>
                                    <p>{{ ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/'," $1",$due->type)) }}</p>
                                </td> --}}
                                <td class="text-xs-right">{{number_format($due->amount / 100)}}</td>
                                <td class="text-xs-right">{{ $due->type != 'oneTime' ? $due->quantity : number_format($due->amount_paid)}}</td>
                                <td class="text-xs-right">{{number_format($due->amount_paid)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-7 col-md-5 col-sm-12">
                        <p class="lead">Total Amount Paid: ₦ {{number_format($payment->amount / 100)}}</p>
                    </div>
                </div>
            </div>
            <p>Your receipt has also been attached to this mail</p>

            <div style="margin-top:2em;">
                <span>Thanks</span><br>
                {{settings('FULL_NAME')}}
            </div>
        </div>

    </section>
</body>
</html>