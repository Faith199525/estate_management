@extends('layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Staffs
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h3 class="blue text-md-center mb-2">New Staff</h3>
                        <p>This is where you register all your staffs / workers. E.g Cooks, Security, househelp etc.</p>
                        <form method="POST" action="{{url('/staffs')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="photo" id="" required>
                                @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('photo') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Staff Name" name="name" value="{{old('name')}}">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="job">Job</label>
                                        <input type="text" class="form-control" placeholder="Job" name="job" value="{{old('job')}}">
                                        @if ($errors->has('job'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('job') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control" placeholder="Gender" name="gender" value="{{old('gender')}}">
                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('gender') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" placeholder="State E.g Delta" name="state" value="{{old('state')}}">
                                        @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('state') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{old('phone')}}">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('phone') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" placeholder="Email E.g Delta" name="email" value="{{old('email')}}">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('email') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="details"> Other Details</label>
                                <textarea rows="6" type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details"
                                    placeholder="Add any other information. You can also leave instructions for security about staff">{{old('details')}}</textarea>
                                @if ($errors->has('details'))
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $errors->first('details') }}</span>
                                </sp>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register Staff</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 ">Staffs</div>
                        {{-- <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter staff name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                New Staff Notification
                            </button>
                        </div> --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">name</th>
                                        <th scope="col">Job</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($staffs) @foreach ($staffs as $key => $staff)
                                    <tr>
                                        <th scope="row">{{$key + $staffs->firstItem()}}</th>
                                        <td>{{$staff->name}}</td>
                                        <td>{{$staff->job}}</td>
                                        <td>{{$staff->details}}</td>
                                        <td><a href="{{url('/staffs/'.$staff->id)}}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Staff Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/staffs')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Staff Name" name="name" value="{{old('name')}}">
                            {{ $errors->first('name') }}
                        </div>
                        <div class="form-group">
                            <label for="expected_date">Date Expected</label>
                            <input type="text" class="form-control" placeholder="Staff Name" name="expected_date" value="{{old('expected_date')}}">
                            {{ $errors->first('expected_date') }}
                        </div>
                        <div class="form-group">
                            <label for="details"> Staff Details</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details"
                                placeholder="Enter staff address. E.g The transformer fuse is now bad">{{old('details')}}</textarea> @if ($errors->has('details'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('details') }}</strong>
                        </span> @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Send Staff Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
