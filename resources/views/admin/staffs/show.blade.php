@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/staffs')}}">All Residents' Staffs</a>
            </li>
            <li class="breadcrumb-item active">Staff
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
                        <div class="col-md-4 ">Staff Details</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        @isset($staff)
                        <div>
                            <span>
                                <img src="{{$staff->photo? url($staff->photo) : ''}}" width="150" height="150" alt="">
                            </span>
                            <hr>
                            <span><strong>Status: </strong> <button class="btn btn-sm btn-info">{{$staff->status ? $staff->status : 'Employed' }}</button></span><br>
                            <span><strong>Name: </strong>{{$staff->name}}</span><br>
                            <span><strong>Job: </strong>{{$staff->job}}</span><br>
                            <span><strong>Gender: </strong>{{$staff->gender}}</span><br>
                            @if (auth()->user()->hasPermission('edit_resident'))
                            <span><strong>State: </strong>{{$staff->state}}</span><br>
                            <span><strong>Email: </strong>{{$staff->email}}</span><br>
                            <span><strong>Phone: </strong>{{$staff->phone}}</span><br>
                            @endif
                            <span><strong>Details: </strong>{{$staff->details}}</span><br>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
