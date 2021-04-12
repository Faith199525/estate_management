@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Settings
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 "><i class="icon-cogs2"></i> Settings</div>
                    </div>
                </div>

                <div class="card-body" style="background-color:antiquewhite">
                    <div class="card-block">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><i class="icon-cog"></i> General Settings</div>
                                    <div class="card-body">
                                        <div class="card-block">
                                            <p>Portal general settings</p>
                                            <form action="settings/app" method="POST">
                                                @csrf
                                                <div class="row form-group">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="app_name">Estate Short Name</label>
                                                        <input type="text" placeholder="Enter Estate Short Name" value="{{settings('APP_NAME')}}" class="form-control" name="app_name">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="full_name">Estate Full Name</label>
                                                        <input type="text" placeholder="Enter Estate Full Name" class="form-control" value="{{settings('FULL_NAME')}}" name="full_name">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class=" col-sm-12">
                                                        <label for="full_address">Estate address</label>
                                                        <textarea class="form-control" placeholder="Enter Full Estate address" name="full_address" id="" rows="3">{{settings('FULL_ADDRESS')}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button class="btn btn-primary">Update General Settings</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header"><i class="icon-mail"></i> Email Settings</div>
                                    <div class="card-body">
                                        <div class="card-block">
                                            <p>How portal email would be sent</p>
                                            <form action="settings/email" method="POST">
                                                @csrf
                                                <div class="row form-group">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="mail_from_address">Mail from Email</label>
                                                        <input type="text" class="form-control" placeholder="Enter sender email adddress" value="{{settings('MAIL_FROM_ADDRESS')}}" name="mail_from_address">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="mail_from_name">Email from Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter the name seen as sender" value="{{settings('MAIL_FROM_NAME')}}" name="mail_from_name">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button class="btn btn-primary">Update Email Settings</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (auth()->user()->hasPermission('edit_settings'))
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div><i class="icon-IcoMoon"></i> Activations</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-block">
                                            <p>This is where you activate the differet features that you want within this portal. This setings affects the entire portal.</p>
                                            <ul class="list-group">
                                                <li class="list-group-item">Online Payment
                                                    <i class="icon-info text-success" data-toggle="popover" data-content="Once you activate payment, residents would be able to pay dues directly from this portal." data-trigger="hover" data-original-title="Online Payment"></i>
                        @if (!settings()->has('PAYMENT_ACTIVATED'))
                            <button type="button" class="btn btn-outline-primary btn-sm float-sm-right" data-toggle="modal" data-target="#payment-activation-modal">Activate</button>   <!-- Modal -->
                            <div class="modal fade text-xs-left" id="payment-activation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel1">Activate payment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <p>To proceed, kindly enter {{settings('FULL_NAME')}} <strong>NUBAN Account no.</strong> All payments would be settled in 24 hours by Paystack.</p>
                                            </div>
                                            <hr>
                                            <div id="account_integration">
                                                <form action="{{url('/admin/settings/payment/activate')}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="settlement_bank">Bank Name
                                                            <i class="icon-info text-success" data-toggle="popover"
                                                            data-content="Select from the list the name of the bank where you opened the account that receives all payments"
                                                            data-trigger="hover" data-original-title="Bank Name."></i>
                                                        </label>
                                                        <select class="form-control" v-model="settlement_bank" name="settlement_bank" id="settlement_bank" required>
                                                            <option value="">Select Bank</option>
                                                            <option v-for="bank in banks" :value="bank.name">@{{bank.name}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="business_name">Account Name
                                                            <i class="icon-info text-success" data-toggle="popover"
                                                            data-content="This is the name of the account that receives all payments"
                                                            data-trigger="hover" data-original-title="Account Name."></i>
                                                        </label>
                                                        <input class="form-control {{ $errors->has('business_name') ? ' is-invalid' : '' }}" name="business_name" type="text" placeholder="Enter Acccount name here..." maxlength="255" required>
                                                        @if ($errors->has('business_name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('business_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="account_number">Account No
                                                            <i class="icon-info text-success" data-toggle="popover"
                                                                data-content="This is the account no that receives all payments"
                                                                data-trigger="hover" data-original-title="Account No."></i>
                                                        </label>
                                                        <input class="form-control {{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" type="text" placeholder="Enter NUBAN Acccount no here..." maxlength="10" minlength="10" required>
                                                        @if ($errors->has('account_number'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('account_number') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form">
                                                        <button type="submit" class="btn block btn-primary">Activate Payment</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <button type="button" class="btn btn-outline-danger btn-sm float-sm-right" data-toggle="modal" data-target="#payment-deactivation-modal">Deactivate</button>
                            <br>
                            <ul>
                                <li>Account Name: {{settings()->get('business_name')}}</li>
                                <li>Account No: <strong>{{settings()->get('PAYMENT_ACCOUNT_NO')}}</strong></li>
                                <li>Bank: {{settings()->get('settlement_bank')}}</li>
                            </ul>
                            <!-- Modal -->
                            <div class="modal fade text-xs-left" id="payment-deactivation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title text-danger" id="myModalLabel1">Deactivate payment?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <p>Due payments would be disabled accross portal. Also, <strong>{{settings('FULL_NAME')}} Account no.</strong> would be deleted from settings.</p>
                                            </div>
                                            <p class="text-danger">Do you really want to deactivate?</p>
                                            <hr>
                                            <form action="{{url('/admin/settings/payment/deactivate')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="form">
                                                    <button type="submit" class="btn block btn-danger">Yes! Deactivate Now</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                                                </li>
                                                <li class="list-group-item">Messaging <i class="icon-info text-success" data-toggle="popover"
                                                    data-content="Allows you to send messages to all residents an landlords via email and SMS"
                                                    data-trigger="hover" data-original-title="Messaging"></i>
                                                    @if (!settings()->has('MESSAGING_ACTIVATED'))
                                                        <button type="button" class="btn btn-outline-primary btn-sm float-sm-right" data-toggle="modal" data-target="#messaging-activation-modal">Activate</button>   <!-- Modal -->
                                                        <div class="modal fade text-xs-left" id="messaging-activation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title" id="myModalLabel1">Activate Messaging</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <p>kindly select the the optons you want to activate.</p>
                                                                        </div>
                                                                        <hr>
                                                                        <form action="{{url('/admin/settings/messaging/activate')}}" method="post">
                                                                            @csrf
                                                                            <div class="form-group col-md-12">
                                                                                <div class="form-check">
                                                                                <input class="form-check-input" name="activate_email" type="checkbox" value="" id="defaultCheck1">
                                                                                @if ($errors->has('activate_email'))
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('activate_email') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                                <label class="form-check-label" for="defaultCheck1">
                                                                                    Email Sending <i class="icon-info text-success" data-toggle="popover"
                                                                                        data-content="You would be able to send Email from the admin pannel to everyone"
                                                                                        data-trigger="hover" data-original-title="Email Activation"></i>
                                                                                </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                <input class="form-check-input" name="activate_sms" type="checkbox" value="" id="defaultCheck2">
                                                                                @if ($errors->has('activate_sms'))
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('activate_sms') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                                <label class="form-check-label" for="defaultCheck2">
                                                                                    SMS Sending  <i class="icon-info text-success" data-toggle="popover"
                                                                                        data-content="You would be able to send SMS from the admin pannel to everyone"
                                                                                        data-trigger="hover" data-original-title="SMS Activation"></i>
                                                                                </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form">
                                                                                <button type="submit" class="btn block btn-primary">Activate</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                    <button type="button" class="btn btn-outline-danger btn-sm float-sm-right" data-toggle="modal" data-target="#messaging-deactivation-modal">Deactivate</button>   <!-- Modal -->
                                                    <div class="modal fade text-xs-left" id="messaging-deactivation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title text-danger" id="myModalLabel1">Deactivate Messaging?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div>
                                                                        <p>Admin would no longer be able to send messages to anyone.</p>
                                                                    </div>
                                                                    <p class="text-danger">Do you really want to deactivate?</p>
                                                                    <hr>
                                                                    <form action="{{url('/admin/settings/messaging/deactivate')}}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="form">
                                                                            <button type="submit" class="btn block btn-danger">Yes! Deactivate Now</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-success btn-sm float-sm-right" data-toggle="modal" data-target="#messaging-updating-modal">Update</button>
                                                        <div class="modal fade text-xs-left" id="messaging-updating-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title" id="myModalLabel1">Update Messaging</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <p>kindly check the the optons you want to activate and uncheck the options you want to deactivate.</p>
                                                                        </div>
                                                                        <hr>
                                                                        <form action="{{url('/admin/settings/messaging/update')}}" method="post">
                                                                            @csrf
                                                                            <div class="form-group col-md-12">
                                                                                <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" value="" name="activate_email"
                                                                                @if (settings()->has('ACTIVATE_EMAIL') && settings('ACTIVATE_EMAIL') == true) checked @endif
                                                                                id="defaultCheck1">
                                                                                <label class="form-check-label" for="defaultCheck1">
                                                                                    Email Sending <i class="icon-info text-success" data-toggle="popover"
                                                                                        data-content="You would be able to send Email from the admin pannel to everyone"
                                                                                        data-trigger="hover" data-original-title="Email Activation"></i>
                                                                                </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                <input class="form-check-input" name="activate_sms"
                                                                                @if (settings()->has('ACTIVATE_SMS') && settings('ACTIVATE_SMS') == true) checked @endif
                                                                                type="checkbox" value="" id="defaultCheck2">
                                                                                <label class="form-check-label" for="defaultCheck2">
                                                                                    SMS Sending  <i class="icon-info text-success" data-toggle="popover"
                                                                                        data-content="You would be able to send SMS from the admin pannel to everyone"
                                                                                        data-trigger="hover" data-original-title="SMS Activation"></i>
                                                                                </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form">
                                                                                <button type="submit" class="btn block btn-success">Update</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </li>
                                                <li class="list-group-item">
                                                    @if (!settings()->has('MANUAL_DUE_MANAGEMENT_ACTIVATED'))
                                                    <form action="{{url('/admin/settings/manual_due/activate')}}" method="post">
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Are you sure you want to Activate manual Due management?')" class="btn btn-sm btn-outline-primary float-xs-right">Activate</button>
                                                    </form>
                                                    @else
                                                    <form action="{{url('/admin/settings/manual_due/deactivate')}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to Deactivate manual Due management?')" class="btn btn-sm btn-outline-danger float-xs-right">Deactivate</button>
                                                    </form>
                                                    @endif
                                                    Manual due management <i class="icon-info text-success" data-toggle="popover"
                                                    data-content="You would be able to manualy manage due payments that are paid offline (pos, bank deposites etc)."
                                                    data-trigger="hover" data-original-title="Manual Due Management"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="/main/app-assets/js/scripts/popover/popover.js" type="text/javascript"></script>

@if (auth()->user()->hasPermission('edit_settings'))
    @if (!settings()->has('PAYMENT_ACTIVATED'))

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        data = {
            settlement_bank: '',
            banks:[],

            hasError: false,
            errorMessage: '',
        }

        new Vue({
            el: '#account_integration',
            data: data,
            mounted: function () {
                $.ajax({
                    "type":"GET",
                    "url": "https://api.paystack.co/bank",
                    success: function (resp) {
                        data.banks = resp.data;
                    },
                    error: function (error) {
                        data.hasError = true
                        data.errorMessage = "Could not fetch bank list. Kindy refresh page!"
                    }
                });
            },
        })
    </script>
    @endif
@endif

@endsection
