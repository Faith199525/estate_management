@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Landlord Profile
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class=" col-md-6">
                <div class="card">
                    <div class="card-header">Profile
                        <a href="/landlords-profile/edit" class="btn btn-sm btn-info pull-right">Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <span><strong>Full name:</strong> {{$landlord->fullname}}</span><br>
                            <span><strong>Phone no:</strong> {{$landlord->phone}}</span><br>
                            <span><strong>Email:</strong> {{$landlord->email}}</span><br>
                            <span><strong>Contact Address:</strong> {{$landlord->address}}</span><br>
                            <span><strong>Current Residential Address:</strong> {{$landlord->current_residential_address}}</span><br>
                            <span><strong>Occupation:</strong> {{$landlord->occupation}}</span><br>
                            <span><strong>Office Address:</strong> {{$landlord->office_address}}</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection