@extends('layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/staffs')}}">All Staffs</a>
            </li>
            <li class="breadcrumb-item active">Staff
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 ">Staff</div>
                        <div class="col-md-6 ">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                Edit Staff
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModalDelete">
                                Delete Staff
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                    @isset($staff)
                        <span>
                            <img src="{{$staff->photo? url($staff->photo) : ''}}" width="150" height="150" alt="">
                        </span>
                        <hr>
                        <span><strong>Name: </strong>{{$staff->name}}</span><br>
                        <span><strong>Job: </strong>{{$staff->job}}</span><br>
                        <span><strong>Gender: </strong>{{$staff->gender}}</span><br>
                        <span><strong>State: </strong>{{$staff->state}}</span><br>
                        <span><strong>Email: </strong>{{$staff->email}}</span><br>
                        <span><strong>Phone: </strong>{{$staff->phone}}</span><br>
                        <span><strong>Details: </strong>{{$staff->details}}</span><br>
                    @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/staffs/' . $staff->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="file" name="photo">
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
                                    <input type="text" class="form-control" placeholder="Staff Name" name="name" value="{{old('name') ? old('name') : $staff->name}}">
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('name') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="job">Job</label>
                                    <input type="text" class="form-control" placeholder="Job" name="job" value="{{old('job') ? old('job') : $staff->job}}">
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
                                    <input type="text" class="form-control" placeholder="Gender" name="gender" value="{{old('gender') ? old('gender') : $staff->gender}}">
                                    @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('gender') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" placeholder="State E.g Delta" name="state" value="{{old('state') ? old('state') : $staff->state}}">
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
                                    <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{old('phone') ? old('phone') : $staff->phone}}">
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('phone') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" placeholder="Email E.g Delta" name="email" value="{{old('email') ? old('email') : $staff->email}}">
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
                                placeholder="Add any other information. You can also leave instructions for security about staff">{{old('details') ? old('details') : $staff->details}}</textarea>
                            @if ($errors->has('details'))
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $errors->first('details') }}</span>
                            </sp>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Delete Modal -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDelete">Delete Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <p class="text-danger text-center">Are You really sure you want to delete this Staff?</p>
                    <form method="POST" action="{{url('/staffs/' . $staff->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" value="{{$staff->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Enter staff address. E.g Embassy close, Off Association Road" name="details" id="details" readonly>{{old('details') ? old('details') : $staff->details}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Delete Staff</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
