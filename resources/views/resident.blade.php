@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Your Resident profile
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @isset($residents)
                @foreach($residents as $resident)
                <div class=" col-md-6">
                    <div class="card">
                        <div class="card-header">Profile
                            <a href="/resident-profile/{{$resident->id}}/edit" class="btn btn-sm btn-info pull-right">Edit</a>
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
                @endforeach
            @endisset
        </div>
    </div>
</div>
@endsection