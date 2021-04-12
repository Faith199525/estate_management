@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Residents
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
                            <div class="col-md-6 ">Dashboard</div>
                            <div class="col-md-6 ">
                                <form class="form-inline" style="float:right;" action="">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="q" placeholder="Enter name or email address">
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
                                        @if (auth()->user()->hasPermission('edit_resident'))
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        @endif
                                        <th scope="col">Address</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($residents) @foreach ($residents as $key => $resident)
                                    <tr>
                                        <th scope="row">{{$key + $residents->firstItem()}}</th>
                                        <td>{{$resident->fullname}}</td>
                                        @if (auth()->user()->hasPermission('edit_resident'))
                                        <td>{{$resident->phone}}</td>
                                        <td>{{$resident->email}}</td>
                                        @endif
                                        <td>{{$resident->property->address}}</td>
                                        <td><a href="{{url('/admin/residents/'.$resident->id)}}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($residents)
                {{ $residents->links() }}
            @endisset
        </div>
    </div>
</div>
@endsection
