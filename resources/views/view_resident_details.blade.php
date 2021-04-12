@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/properties')}}">All Properties</a>
            @isset($resident)
            <li class="breadcrumb-item"><a href="{{url('/properties/'. $resident->property->id)}}">Property</a>
            </li>
            @endisset
            <li class="breadcrumb-item active">Resident
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @isset($resident)
                <div class=" col-md-6">
                    <div class="card">
                        <div class="card-header">Resident Profile
                        </div>
                        <div class="card-body">
                        @isset($resident)
                        <div class="card-block">
                            <span>
                                <img src="{{$resident->photo? url($resident->photo) : ''}}" width="150" height="150" alt="">
                            </span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Residence:</strong> {{$resident->property->address}}
                            </li>
                            <li class="list-group-item">
                                <strong>Full name:</strong> {{$resident->fullname}}
                            </li>
                            <li class="list-group-item">
                                <strong>Phone No:</strong> {{$resident->phone}}
                            </li>
                            <li class="list-group-item">
                                <strong>Email:</strong> {{$resident->email}}
                            </li>
                            <li class="list-group-item">
                                <strong>Date of Birth:</strong> {{$resident->dob}}
                            </li>
                            <li class="list-group-item">
                                <strong>Occupation:</strong> {{$resident->occupation}}
                            </li>
                            <li class="list-group-item">
                                <strong>Office Address:</strong> {{$resident->office_address}}
                            </li>
                            <li class="list-group-item">
                                <strong>Marital Status:</strong> {{$resident->marital_status}}
                            </li>
                            <li class="list-group-item">
                                <strong>Spouse Occupation:</strong> {{$resident->spouse_occupation}}
                            </li>
                            <li class="list-group-item">
                                <strong>No of Occupants:</strong> {{$resident->no_of_occupants}}
                            </li>
                            <li class="list-group-item">
                                <strong>Occupancy Start Date:</strong> {{$resident->occupancy_start_date}}
                            </li>
                            <li class="list-group-item">
                                <strong>No of Vehicles:</strong> {{$resident->no_of_vehicles}}
                            </li>
                            <li class="list-group-item">
                                <strong>Vehicle type and Registration Numbers:</strong> {{$resident->vehicle_type_and_registration_numbers}}
                            </li>
                        </ul>
                        @endisset
                        </div>
                    </div>
                </div>
                @endisset
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($resident->user->payments->isNotEmpty())
                                                @foreach($resident->user->payments as $key => $payment)
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
                                                                Confirmed by Admin
                                                        </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
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