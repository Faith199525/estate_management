@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<style>
    [v-cloak] { display: none; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Dues
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center" id="duepayment">

        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <h5><strong> Dues and Payment</strong></h5>
                            <div class="nav-vertical">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" aria-expanded="true">Pay Dues</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab" aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2" aria-expanded="false">Dues Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab" aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3" aria-expanded="false">Dues Status</a>
                                    </li>
                                </ul>
                                <div class="tab-content px-1">
                                    <div role="tabpanel" class="tab-pane active" id="tabVerticalLeft1" aria-expanded="true" aria-labelledby="baseVerticalLeft-tab1">
                                        <div class="table-responsive" v-cloak>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Due Name</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th style="min-width:18em">Quantity / Amount</th>
                                                        <th>Total (₦)</th>
                                                    </tr>
                                                </thead>
                                                <form id="pay_form" @submit.prevent="makePayment">
                                                    @csrf
                                                    <tbody>
                                                        <tr v-for="due in dues">
                                                            <td>
                                                                <input form="pay_form" @click="addDue(due, $event)" type="checkbox" id="due">
                                                            </td>
                                                            <td>@{{ due.name }}</td>
                                                            <td>@{{ due.type.replace( /([A-Z])/g, " $1").charAt(0).toUpperCase() + due.type.replace( /([A-Z])/g, " $1").slice(1) }}
                                                            </td>
                                                            <td>₦@{{ Number(due.amount / 100).toLocaleString() }}</td>
                                                            <td v-if="due.type == 'oneTime'">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">₦</span>
                                                                    <input form="pay_form" class="form-control" type="number" id="amount" @change="updateGrandTotal()" v-model="due.amount_paid" placeholder="Amount E.g 50000" aria-label="Amount (to the nearest naira)">
                                                                    <span class="input-group-addon">.00</span>
                                                                </div>
                                                            </td>
                                                            <td v-else>
                                                                <input form="pay_form" class="form-control" type="number" @change="increaseQuantity(due, $event)" v-model="due.quantity" id="quantity" placeholder="Quantity E.g 2 for 2 months" max="24">
                                                            </td>
                                                            <td>
                                                                @{{ due.amount_paid ? Number(due.amount_paid).toLocaleString() : 0 }}
                                                                <input form="pay_form" type="hidden">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top: 0.2em solid royalblue;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><strong>Grand Total (₦)</strong></td>
                                                            <td><strong>@{{Number(sum).toLocaleString()}}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="3">
                                                                <div id="success" style="text-align: center; color: green"></div>
                                                            </td>
                                                            <td colspan="2" class="form-group">
                                                            <button :disabled="!(sum > 100)" form="pay_form" type="submit" class="btn btn-block btn-primary">Pay - (₦ @{{Number(sum).toLocaleString()}})</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </form>
                                            </table>
                                        </div>
                                        {{--  <div v-if="success" class="alert alert-success" role="alert" id="success"></div>  --}}
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft2" aria-labelledby="baseVerticalLeft-tab2">
                                        @isset($dues)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Details</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dues as $due)
                                                    <tr>
                                                        <td>{{$due->name}}</td>
                                                        <td>{{$due->details}}</td>
                                                        <td>{{$due->type}}</td>
                                                        <td>₦{{$due->amount / 100}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endisset
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft3" aria-labelledby="baseVerticalLeft-tab3">
                                        @isset($newStandings)
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Details</th>
                                                            <th>Type</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($newStandings as $newStanding)
                                                        <tr>
                                                            <td>{{$newStanding->due->name}}</td>
                                                            <td>{{$newStanding->due->details}}</td>
                                                            <td>{{$newStanding->due->type}}</td>
                                                            <td>₦{{$newStanding->standing}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endisset

                                                    <!-- <tr v-for="standing in standingDues">
                                                        <td>@{{standing.due.name}}</td>
                                                        <td>@{{standing.due.type}}</td>
                                                        <td>₦@{{standing.outstanding}}</td>                                                        
                                                        <td>@{{standing.due.details}}</td>
                                                    </tr> -->
                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <h5 class="text-center"><strong>Past  Payments</strong></h5>
                                <div class="table-responsive">
                                    <table id="paid-dues"class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Channel</th>
                                                <th>Dues</th>
                                                <th>status</th>
                                                <th>Receipt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($payments)
                                                @foreach($payments as $key => $payment)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$payment->created_at->diffForHumans()}}</td>
                                                    {{--  <td>{{$payment->due->name}}</td>
                                                    <td>{{$payment->due_quantity}}</td>  --}}
                                                    <td>₦{{number_format($payment->amount / 100)}}</td>
                                                    <td>{{ucwords($payment->channel)}}</td>
                                                    <td>
                                                        <span class="small">
                                                            @if($dues_paid = json_decode($payment->dues_paid))
                                                            {{--  $due->type != 'oneTime'  --}}
                                                                @foreach($dues_paid as $p_due)
                                                                <li>{{$p_due->name}} {{$p_due->type != 'oneTime' ? ' * ' . $p_due->quantity : ''}} : ₦{{number_format($p_due->amount_paid)}}</li>
                                                                @endforeach
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($p_dmp = json_decode($payment->paystack_dump))
                                                        {{$p_dmp->message == 'Verification successful' ? 'Verified' : 'Not Verified'}}
                                                        @else
                                                        <span class="small">
                                                                Confirmed by Admin
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a target="_blank" href="{{url('/payment/'. $payment->id . '/receipt?d=0')}}">view</a>
                                                        <a target="_blank" href="{{url('/payment/'. $payment->id . '/receipt?d=1')}}"><i class="icon-download4"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
    data = {
        {{--  success:false,  --}}
        selectedDues: [],
        dues: {!! $dues !!},
        sum: 0
    }

    data.dues.forEach(function(due) {
        due['amount_paid'] = 0;
        due['checked'] = false;
        due['quantity'] = 1;
    });

    new Vue({
        el: '#duepayment',
        data: data,
        mounted: function () {
            const plugin = document.createElement("script");
            plugin.setAttribute(
                "src", "//js.paystack.co/v1/inline.js"
            );
            plugin.async = true;
            document.head.appendChild(plugin);
            this.calculateStandingDues()
        },
        methods: {
            addDue: function (val, event) {
                index = data.dues.findIndex(obj => obj.id == val.id);
                if (index == 0 || index) {
                    if(event.target.checked){
                        data.dues[index]['checked'] = true;
                        data.dues[index]['amount_paid'] = Number(val.amount * val.quantity / 100);
                    } else {
                        data.dues[index]['checked'] = false;
                        data.dues[index]['amount_paid'] = 0;
                    }
                    this.updateGrandTotal();
                }


                const found = data.selectedDues.some(el => el.id === val.id);
                if (!found) data.selectedDues.push(val);
                if (found) {
                    data.selectedDues = data.selectedDues.filter(obj => obj.id !== val.id);
                }
            },
            increaseQuantity: function (val, event) {
                if(val.checked == true){
                    index = data.dues.findIndex(obj => obj.id == val.id);
                    data.dues[index]['amount_paid'] = Number(val.amount / 100 * val.quantity);
                    this.updateGrandTotal();
                }
            },
            updateGrandTotal: function () {
                data.sum = data.dues.reduce((acc, item) => acc + Number(item.amount_paid), 0);
            },
            makePayment: function () {
                {{--  var vueData = data.success;  --}}
                var fund_amt = data.sum * 100;
                var handler = PaystackPop.setup({
                    key: '{{env('PAYSTACK_PUBLIC_KEY')}}',
                    email: '{{ \Auth::user()->email }}',
                    amount: fund_amt,
                    subaccount: '{{settings()->get("subaccount_code")}}',
                    bearer: 'subaccount',
                    // ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    callback: function(response){
                      $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        "type":"POST",
                        "url": "/pay",
                        "data": {
                          "amount"    : fund_amt,
                          "trans_ref" : response.reference,
                          "authorization_code" : response.reference,
                          "paystack_dump" : response,
                          "dues_paid" : data.selectedDues,
                        },
                        success: function(data) {
                            {{--  vueData.success = true;  --}}
                          $("#success").html(data.msg);
                          setTimeout(function() {
                            location.reload();
                          }, 3000);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                          console.log(xhr.responseText);
                        }
                      });
                    },
                });

                handler.openIframe();

            },

        }
    })
</script>
<script>
    $(document).ready(function() {
        $('#paid-dues').DataTable();
    } );
</script>

@endsection

