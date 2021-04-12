@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/residents')}}">All Residents</a>
            </li>
            <li class="breadcrumb-item active">Resident
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
                        <div class="col-md-4 ">Resident Details</div>
                        {{--  <div class="col-md-6 ">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                Edit Resident
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModalDelete">
                                Delete Resident
                            </button>
                        </div>  --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        @isset($resident)
                        <div>
                            <span>
                                <img src="{{$resident->photo? url($resident->photo) : ''}}" width="150" height="150" alt="">
                            </span>
                            <br>
                            <span><strong>Residence:</strong> {{$resident->property->address}}</span><br>
                            <span><strong>Full name:</strong> {{$resident->fullname}}</span><br>
                            @if (auth()->user()->hasPermission('edit_resident'))
                            <span><strong>Phone No:</strong> {{$resident->phone}}</span><br>
                            <span><strong>Email:</strong> {{$resident->email}}</span><br>
                            <span><strong>Date of Birth:</strong> {{$resident->dob}}</span><br>
                            <span><strong>Occupation:</strong> {{$resident->occupation}}</span><br>
                            <span><strong>Office Address:</strong> {{$resident->office_address}}</span><br>
                            <span><strong>Marital Status:</strong> {{$resident->marital_status}}</span><br>
                            <span><strong>Spouse Occupation:</strong> {{$resident->spouse_occupation}}</span><br>
                            @endif
                            <span><strong>No of Occupants:</strong> {{$resident->no_of_occupants}}</span><br>
                            <span><strong>Occupancy Start Date:</strong> {{$resident->occupancy_start_date}}</span><br>
                            <span><strong>No of Vehicles:</strong> {{$resident->no_of_vehicles}}</span><br>
                            <span><strong>Vehicle type and Registration Numbers:</strong> {{$resident->vehicle_type_and_registration_numbers}}</span><br>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
