@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/landlords')}}">All Landlords</a>
            </li>
            <li class="breadcrumb-item active">Landlord
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
                        <div class="col-md-4 ">Landlord Details</div>
                        {{--  <div class="col-md-6 ">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                Edit Landlord
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModalDelete">
                                Delete Landlord
                            </button>
                        </div>  --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                    @isset($landlord)
                        <span><strong>Full name:</strong> {{$landlord->fullname}}</span><br>
                        @if (auth()->user()->hasPermission('edit_landlord'))
                        <span><strong>Phone no:</strong> {{$landlord->phone}}</span><br>
                        <span><strong>Email:</strong> {{$landlord->email}}</span><br>
                        <span><strong>Contact Address:</strong> {{$landlord->address}}</span><br>
                        <span><strong>Current Residential Address:</strong> {{$landlord->current_residential_address}}</span><br>
                        <span><strong>Occupation:</strong> {{$landlord->occupation}}</span><br>
                        <span><strong>Office Address:</strong> {{$landlord->office_address}}</span><br>
                        @endif
                    @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
