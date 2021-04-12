@extends('admin.layouts.app')
@section('css')
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
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/users')}}">All Users</a>
            </li>
            <li class="breadcrumb-item active">User
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">User Details</div>

                                <div class="card-body">
                                    <div class="card-block">
                                        Name: {{$user->name}} <br>
                                        @if (auth()->user()->hasPermission('view_user'))
                                        Email: {{$user->email}} <br>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @isset($user->landlord)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Landlord Profile
                                </div>
                                <div class="card-body">
                                    <div class="card-block">
                                        <span><strong>Full name:</strong> {{$user->landlord->fullname}}</span><br>
                                        @if (auth()->user()->hasPermission('edit_landlord'))
                                        <span><strong>Phone no:</strong> {{$user->landlord->phone}}</span><br>
                                        <span><strong>Email:</strong> {{$user->landlord->email}}</span><br>
                                        <span><strong>Contact Address:</strong> {{$user->landlord->address}}</span><br>
                                        <span><strong>Current Residential Address:</strong> {{$user->landlord->current_residential_address}}</span><br>
                                        <span><strong>Occupation:</strong> {{$user->landlord->occupation}}</span><br>
                                        <span><strong>Office Address:</strong> {{$user->landlord->office_address}}</span><br>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endisset
                    </div>
                    @isset($user->residents)
                    @foreach ($user->residents as $resident)
                    <div class="card">
                        <div class="card-header">
                            Resident Profile
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <span>
                                    <img src="{{$resident->photo? url($resident->photo) : ''}}" width="100" height="100" alt="">
                                </span>

                                <ul class="list-group list-group-flush">
                                    <strong>Landord:</strong> <a target="_blank" href="/admin/users/{{$resident->property->landlord->user->id}}">{{$resident->property->landlord->fullname}}</a> <br>
                                    <strong>Residence:</strong> {{$resident->property->address}}<br>
                                    <strong>Full name:</strong> {{$resident->fullname}}<br>
                                    @if (auth()->user()->hasPermission('edit_resident'))
                                    <strong>Phone No:</strong> {{$resident->phone}}<br>
                                    <strong>Email:</strong> {{$resident->email}}<br>
                                    <strong>Date of Birth:</strong> {{$resident->dob}}<br>
                                    <strong>Occupation:</strong> {{$resident->occupation}}<br>
                                    <strong>Office Address:</strong> {{$resident->office_address}}<br>
                                    <strong>Marital Status:</strong> {{$resident->marital_status}}<br>
                                    <strong>Spouse Occupation:</strong> {{$resident->spouse_occupation}}<br>
                                    @endif
                                    <strong>No of Occupants:</strong> {{$resident->no_of_occupants}}<br>
                                    <strong>Occupancy Start Date:</strong> {{$resident->occupancy_start_date}}<br>
                                    <strong>No of Vehicles:</strong> {{$resident->no_of_vehicles}}<br>
                                    <strong>Vehicle type and Registration Numbers:</strong> {{$resident->vehicle_type_and_registration_numbers}}<br>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endisset
                </div>
                @if (auth()->user()->hasPermission('view_role'))
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Assign Role</div>
                        <div class="card-body">
                            <div class="card-block">
                                <div class="">
                                    Name: {{$user->name}} <br>
                                    Email: {{$user->email}} <br>
                                    Role: <span class="btn btn-sm btn-secondary"> {{$user->access ? $user->access->role->name : 'No Role'}}</span> <br>
                                </div>
                                @if (auth()->user()->hasPermission('edit_role'))
                                <hr>
                                <div class="">
                                    <form action="/admin/users/{{$user->id}}/role" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <select name="role" id="" class="form-control">
                                                <option value="">Select Role</option>
                                                <option value="remove">Remove Role</option>
                                                @isset($roles)
                                                    @foreach ($roles as $role)
                                                    <option value="{{$role->id}}" @if ($user->access && $user->access->role_id == $role->id)
                                                        selected
                                                    @endif>{{$role->name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <strong class="red">{{ $errors->first('role') }}</strong>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block pull-right">Update Role</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <strong> AdHocs</strong> are users that should not have access to full User profile e.g Security
                        guards.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @if (auth()->user()->hasPermission('view_payment'))
        @if (settings('PAYMENT_ACTIVATED') == true || settings('MANUAL_DUE_MANAGEMENT_ACTIVATED') == true)
        <div class="row justify-content-center">
            <div id="duepayment" class="col-md-12">
                <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4 ">Past Payments</div>
                                @if(auth()->user()->hasPermission('edit_payment') && settings('MANUAL_DUE_MANAGEMENT_ACTIVATED') == true)
                                <div class="col-md-2 offset-md-6"><button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#large">Add Payment</button></div>
                                @endif
                                @if (auth()->user()->hasPermission('edit_payment'))
                                <!-- Modal -->
                                <div class="modal fade text-xs-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel17">Add Payment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>This is where you add payments that were made outside this platform. E.g Direct Transfer, Bank Deposits etc.</p>
                                            @if ($user->dues())
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>Due Name</th>
                                                            <th class="hidden-sm-down">Type</th>
                                                            <th>Amount</th>
                                                            <th style="min-width:18em">Quantity / Amount</th>
                                                            <th>Total (₦)</th>
                                                        </tr>
                                                    </thead>
                                                    <form id="pay_form" @submit.prevent="makePayment">
                                                        @csrf
                                                        <tbody v-cloak>
                                                            <tr v-for="due in dues">
                                                                <td>
                                                                    <input form="pay_form" @click="addDue(due, $event)" type="checkbox" id="due">
                                                                </td>
                                                                <td>@{{ due.name }}</td>
                                                                <td class="hidden-sm-down">
                                                                    @{{ due.type.replace( /([A-Z])/g, " $1").charAt(0).toUpperCase() + due.type.replace( /([A-Z])/g, " $1").slice(1) }}
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
                                                                <td class="hidden-sm-down"></td>
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
                                                                    <label>
                                                                        <input class="form-control" type="checkbox" v-model="receipt">
                                                                        <span>Send Receipt to User</span>
                                                                    </label>
                                                                    <select v-model="channel" class="form-control {{ $errors->has('channel') ? ' is-invalid' : '' }}">
                                                                        <option value="">Select Payment Channel</option>
                                                                        @if($paymentChannel = \App\Essentials\PaymentChannel::getArray())
                                                                            @foreach ($paymentChannel as $channelKey => $channelValue)
                                                                            <option value="{{$channelKey}}" {{(old('channel') == $channelKey) ? 'selected' : ''}}>{{$channelValue}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @if ($errors->has('channel'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('channel') }}</strong>
                                                                    </span>
                                                                    @endif


                                                                <button :disabled="!(sum > 100) || (channel == '')" form="pay_form" type="submit" class="btn btn-block btn-primary">Add Payment - (₦ @{{Number(sum).toLocaleString()}})</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </form>
                                                </table>
                                            </div>
                                            @else
                                            <p>No due is assigned to this user ({{$user->name}})</p>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Channel</th>
                                            <th>Dues</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($payments)
                                        @if ($payments->isEmpty())
                                            <tr>
                                                <td colspan="6">No payment Yet!</td>
                                            </tr>
                                        @endif
                                            @foreach($payments as $key => $payment)
                                            <tr>
                                                <td>{{$key + $payments->firstItem()}}</td>
                                                <td>{{$payment->created_at->diffForHumans()}}</td>
                                                <td>₦{{number_format($payment->amount / 100)}}</td>
                                                <td>{{ucwords($payment->channel)}}</td>
                                                <td>
                                                    <span class="small">
                                                        @if($dues_paid = json_decode($payment->dues_paid))
                                                            @foreach($dues_paid as $p_due)
                                                            <li>{{$p_due->name}} {{$p_due->quantity > 1 ? ' * ' . $p_due->quantity : ''}} : ₦{{number_format($p_due->amount_paid)}}</li>
                                                            @endforeach
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($p_dmp = json_decode($payment->paystack_dump))
                                                    {{$p_dmp->message == 'Verification successful' ? 'Verified' : 'Not Verified'}}
                                                    @else
                                                    <span class="small">
                                                            Confirmed by
                                                            @if ($a_user = \App\User::find($payment->created_by))
                                                                <a href="/admin/users/{{$a_user->id}}">
                                                                    {{$a_user->name}}
                                                                </a>
                                                            @else
                                                                Admin
                                                            @endif
                                                    </span>
                                                    @endif
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
                @isset($payments)
                {{ $payments->links() }}
                @endisset
            </div>
        </div>
        @endif
    @endif



</div>
@endsection
@if (auth()->user()->hasPermission('view_payment'))
    @section('scripts')
        @if ($user->dues())
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script>
            data = {
                {{--  success:false,  --}}
                selectedDues: [],
                dues: {!! $user->dues() !!},
                sum: 0,
                channel: '',
                receipt: ''
            }

            data.dues.forEach(function(due) {
                due['amount_paid'] = 0;
                due['checked'] = false;
                due['quantity'] = 1;
            });

            new Vue({
                el: '#duepayment',
                data: data,
                {{--  mounted: function () {
                    const plugin = document.createElement("script");
                    plugin.setAttribute(
                        "src", "//js.paystack.co/v1/inline.js"
                    );
                    plugin.async = true;
                    document.head.appendChild(plugin);
                },  --}}
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
                        if(confirm('Do you really want to add this payment?')){
                            var fund_amt = data.sum * 100;
                            $.ajax({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },

                                "type":"POST",
                                "url": "/admin/pay",
                                "data": {
                                "amount"    : fund_amt,
                                "channel"    : data.channel,
                                "receipt"    : data.receipt,
                                "user_id" : '{{ $user->id }}',
                                "created_by" : '{{ \Auth::user()->id }}',
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
                        }
                    }
                }
            })
        </script>
        @endif
    @endsection
@endif
