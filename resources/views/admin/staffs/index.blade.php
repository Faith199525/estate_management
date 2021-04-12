@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Residents' Staffs
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
                        <div class="col-md-12">
                            <div class="col-md-4 ">Residents' Staff</div>
                            <div class="col-md-8 ">
                                <form class="form-inline" style="float:right;" action="">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="q" placeholder="Type name, job, State, address">
                                        <button class="btn  btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Job</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($staffs)
                                        @foreach ($staffs as $key => $staff)
                                        <tr>
                                            <th scope="row">{{$key + $staffs->firstItem()}}</th>
                                            <td>{{$staff->name}}</td>
                                            <td>{{$staff->job}}</td>
                                            <td>{{$staff->gender}}</td>
                                            <td>{{$staff->status ? $staff->status : 'Employed'}}</td>
                                            <td>{{$staff->details}}</td>
                                            <td><a href="{{url('/admin/staffs/'.$staff->id)}}" class="btn btn-sm btn-primary">View</a>
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
            @isset($staffs)
                {{ $staffs->links() }}
            @endisset
        </div>
    </div>
</div>
@endsection
