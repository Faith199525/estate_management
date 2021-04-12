@extends('superAdmin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/central/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Estates
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
                        <div class="col-md-4 ">Estates</div>
                        <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter estate name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        @if (auth()->user()->hasPermission('edit_due'))
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New Estate
                            </button>
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
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Short Name</th>
                                        <th scope="col">Full Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($estates) @foreach ($estates as $key => $estate)
                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td>{{$estate->full_name}}</td>
                                        <td>{{$estate->app_name}}</td>
                                        <td>{{$estate->full_address}}</td>
                                        <td><a href="{{url('/central/estate/show/'.$estate->id)}}" class="btn btn-sm btn-success">View</a> </td>
                                        <td><a href="{{url('/central/estate/'.$estate->id)}}" class="btn btn-sm btn-danger">Delete</a> </td>
                                       
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (auth()->user()->hasPermission('edit_due'))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Add New Estate</h5>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/central/estate/create')}}">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" value="{{old('full_name')}}" placeholder="Enter a name for this estate" class="form-control {{ $errors->has('full_name') ? ' is-invalid' : '' }}">
                            @if ($errors->has('full_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('full_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="short_name">Short Name</label>
                            <input type="text" value="{{old('app_name')}}" class="form-control {{ $errors->has('app_name') ? ' is-invalid' : '' }}" placeholder="Enter estate shortname" name="app_name" id="app_name">
                                @if ($errors->has('app_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('app_name') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Full Address</label>
                            <input type="text" value="{{old('full_address')}}" class="form-control {{ $errors->has('full_address') ? ' is-invalid' : '' }}" placeholder="Enter estate address" name="full_address" id="full_address">
                                @if ($errors->has('full_address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('full_address') }}</strong>
                                </span>
                                @endif
                        </div>
                      
                        <h5 class="modal-title" id="exampleModalLabel">Add Estate Admin</h5>
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="username" value="{{old('username')}}" placeholder="Enter a name for this estate's Admin" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}">
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" placeholder="Enter an email for this estate's Admin" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Add Estate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
