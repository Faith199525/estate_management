@extends('superAdmin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/central/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">View Estate
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                        <form method="POST" action="{{url('/central/estate/edit/' . $estate->id )}}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Estate Full Name</label>
                                <input id="name" value="{{ $estate->full_name }}" type="text" class="form-control {{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" required>
                                @if ($errors->has('full_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('full_name') }}</strong>
                            </span>
                            @endif
                        
                        </div>

                        <div class="form-group">
                            <label for="short_name">Estate ShortName</label>
                                <input id="short_name" value="{{ $estate->app_name }}" type="text" class="form-control {{ $errors->has('app_name') ? ' is-invalid' : '' }}" name="app_name" required>
                                @if ($errors->has('app_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('app_name') }}</strong>
                            </span>
                            @endif
                
                        </div>

                        <div class="form-group">
                            <label for="address">Estate Address</label>
                                <input id="full_address" value="{{ $estate->full_address }}" type="text" class="form-control {{ $errors->has('full_address') ? ' is-invalid' : '' }}" name="full_address" required>
                                @if ($errors->has('full_address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('full_address') }}</strong>
                            </span>
                            @endif
                
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                Update Estate
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    
                    <div class="card-block">
                    <h5 class="text-md-center">ESTATE ADMIN(s)</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                     <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($estate) @foreach ($estate->user as $key => $admin)
                                    <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td><a href="{{url('/central/estate/'.$estate->id)}}" class="btn btn-sm btn-danger">Disable</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <h5 class="text-md-center">ADD NEW ESTATE ADMIN</h5>

                    <form method="POST" action="{{url('/central/estate/admin/add/' . $estate->id )}}">
                        @csrf

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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                Add
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>

@endsection
