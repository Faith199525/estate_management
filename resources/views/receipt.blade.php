<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/bootstrap.css")}}">
    <!-- font icons-->
    {{--  <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/fonts/icomoon.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/fonts/flag-icon-css/css/flag-icon.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/vendors/css/extensions/pace.css")}}">  --}}
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/bootstrap-extended.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/app.css")}}">
    {{--  <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/colors.css")}}">  --}}
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    {{--  <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/core/menu/menu-types/vertical-menu.css")}}">
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css")}}">  --}}
    <link rel="stylesheet" type="text/css" href="{{url("/main/app-assets/css/pages/invoice.css")}}">
    <!-- END Page Level CSS-->
    {{--  <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url("/main/assets/css/style.css")}}">
    <!-- END Custom CSS-->  --}}
    

</head>
<body style="background-color:white;">

    {{--  <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-body">
        </div>
    </div>
</div>  --}}
        <section class="card" style="border: #2196F3 0.1em solid;">
            <div id="invoice-template" class="card-block">
                <!-- Invoice Company Details -->
                <div id="invoice-company-details" class="row">
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                        {{--  <img src="{{url("/main/app-assets/images/logo/robust-80x80.png")}}" alt="company logo" class=""/>  --}}
                        <ul class="px-0 list-unstyled">
                            <li class="text-bold-800">{{strtoupper(settings('FULL_NAME', 'ERMS'))}}</li>
                            <li>{{settings('FULL_ADDRESS', '')}},</li>
                            <li>Lagos,</li>
                            <li>Nigeria</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-right">
                        <h2>RECEIPT</h2>
                        {{-- <p class="pb-3"># INV-001001</p> --}}
                        <ul class="px-0 list-unstyled">
                            <li>Amount Paid</li>
                            <li class="lead text-bold-800">₦ {{number_format($payment->amount / 100)}}</li>
                            <li><span class="text-muted">Date: </span> {{date('d/m/Y', strtotime($payment->created_at))}}</li>
                            <li><span class="text-muted">Channel: </span>{{$payment->channel ? ucwords($payment->channel) : 'N/A'}}</li>
                        </ul>
                    </div>
                </div>
                <!--/ Invoice Company Details -->

                <!-- Invoice Customer Details -->
                <div id="invoice-customer-details" class="row pt-2">
                    <div class="col-sm-12 text-xs-center text-md-left">
                        <p class="text-muted">Paid By</p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                        <ul class="px-0 list-unstyled">
                            <li class="text-bold-800">{{ucwords($payment->user->name)}}</li>
                            @if (!empty($payment->user->residents) && $residentProfile = $payment->user->residents->first())
                                <li>{{$residentProfile->property->house_no . ' ' . $residentProfile->property->street->details}}</li>
                                <li>{{$residentProfile->property->street->zone}}</li>
                                <li>{{settings('FULL_ADDRESS', '')}},</li>
                                <li>Nigeria</li>
                            @elseif ($payment->user->landlord && $landlordProfile = $payment->user->landlord)
                                <li>{{$landlordProfile->address}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!--/ Invoice Customer Details -->

                <!-- Invoice Items Details -->
                <div id="invoice-items-details" class="pt-2">
                    <div class="row">
                        <div class="table-responsive col-sm-12">
                            <table class="table">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Due Type</th>
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
                                    <td>
                                        <p>{{ ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/'," $1",$due->type)) }}</p>
                                    </td>
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

                {{--  <!-- Invoice Footer -->
                <div id="invoice-footer">
                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                            <h6>Terms & Condition</h6>
                            <p>You know, being a test pilot is not always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
                        </div>
                        <div class="col-md-5 col-sm-12 text-xs-center">
                           <!-- <button type="button" class="btn btn-primary btn-lg my-1"><i class="icon-paperplane"></i> Send Invoice</button> -->
                        </div>
                    </div>
                </div>
                <!--/ Invoice Footer -->  --}}

            </div>
        </section>
    


    {{--  <script src="{{url("/main/app-assets/js/core/libraries/jquery.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/ui/tether.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/js/core/libraries/bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/ui/unison.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/ui/blockUI.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/ui/jquery.matchHeight-min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/ui/screenfull.min.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/vendors/js/extensions/pace.min.js")}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{url("/main/app-assets/js/core/app-menu.js")}}" type="text/javascript"></script>
    <script src="{{url("/main/app-assets/js/core/app.js")}}" type="text/javascript"></script>  --}}


</body>
</html>