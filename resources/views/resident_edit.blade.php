@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/resident-profile')}}">Your Resident profile</a>
            </li>
            <li class="breadcrumb-item active">Edit
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class=" col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <div class="card-block">
                            <form class="form" method="POST" action="{{url('/resident-profile/'. $resident->id)}}" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="">
                                        <span class="col">
                                            <span class="">Old Photo</span>
                                            <img src="{{$resident->photo? url($resident->photo) : ''}}" width="150" height="150" alt="">
                                        </span>
                                        <vr>
                                        <span class="col">
                                            <img id="output" width="150" height="150"/>
                                        </span>

                                        <input type="file" name="photo" accept="image/*" onchange="loadFile(event)" class="form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}">
                                        @if($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                        </span> 
                                        @endif
                                        <script>
                                            var loadFile = function(event){
                                                var output = document.getElementById('output');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                            };
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Enter Full Name</label>
                                    <input type="text" name="fullname" value="{{old('fullname') ? old('fullname') : $resident->fullname}}" class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                        id="fullname" placeholder="Enter Your Full Name">
                                        @if($errors->has('fullname'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fullname') }}</strong>
                                        </span> 
                                        @endif
                                </div>
                                @method('PUT') @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{old('email') ? old('email') : $resident->email}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        id="email" placeholder="Enter Email address."> 
                                        @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> 
                                        @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $resident->phone}}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            id="phone" placeholder="Enter Phone no."> 
                                            @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span> @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" value="{{old('dob') ? old('dob') : $resident->dob}}" class="form-control {{ $errors->has('dob') ? ' is-invalid' : '' }}"
                                            id="dob" placeholder="Enter Your DOB"> 
                                            @if($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span> 
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" name="occupation" value="{{old('occupation') ? old('occupation') : $resident->occupation}}" class="form-control {{ $errors->has('occupation') ? ' is-invalid' : '' }}"
                                        id="occupation" placeholder="Enter Your Occupation"> 
                                        @if($errors->has('occupation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('occupation') }}</strong>
                                        </span> 
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="office_address">Office Address</label>
                                    <textarea class="form-control {{ $errors->has('office_address') ? ' is-invalid' : '' }}" name="office_address" id="office_address"
                                        placeholder="Enter Your Office Address">{{old('office_address') ? old('office_address') : $resident->office_address}}</textarea>                                    
                                        @if ($errors->has('office_address'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('office_address') }}</strong>
                                        </span> @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <input type="text" name="marital_status" value="{{old('marital_status') ? old('marital_status') : $resident->marital_status}}" class="form-control {{ $errors->has('marital_status') ? ' is-invalid' : '' }}"
                                        id="marital_status" placeholder="Enter Your Marital Status"> 
                                        @if($errors->has('marital_status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                        </span> 
                                        @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="spouse_occupation">Spouse Occupation (N/A if single) </label>
                                        <input type="text" name="spouse_occupation" value="{{old('spouse_occupation') ? old('spouse_occupation') : $resident->spouse_occupation}}" class="form-control {{ $errors->has('spouse_occupation') ? ' is-invalid' : '' }}"
                                            id="spouse_occupation" placeholder="Your Spouse's Occupation. (Write Not Applicable if Single)"> 
                                            @if($errors->has('spouse_occupation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('spouse_occupation') }}</strong>
                                            </span> 
                                            @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="no_of_occupants">No of Occupants</label>
                                        <input type="number" name="no_of_occupants" value="{{old('no_of_occupants') ? old('no_of_occupants') : $resident->no_of_occupants}}" class="form-control {{ $errors->has('no_of_occupants') ? ' is-invalid' : '' }}"
                                            id="no_of_occupants" placeholder="No of Occupants"> 
                                            @if($errors->has('no_of_occupants'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('no_of_occupants') }}</strong>
                                            </span> 
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="occupancy_start_date">Occupancy Start Date</label>
                                        <input type="date" name="occupancy_start_date" value="{{old('occupancy_start_date') ? old('occupancy_start_date') : $resident->occupancy_start_date}}" class="form-control {{ $errors->has('occupancy_start_date') ? ' is-invalid' : '' }}"
                                            id="occupancy_start_date" placeholder="When You moved in."> 
                                            @if($errors->has('occupancy_start_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('occupancy_start_date') }}</strong>
                                            </span> 
                                            @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="no_of_vehicles">No of Vehicles</label>
                                        <input type="number" name="no_of_vehicles" value="{{old('no_of_vehicles') ? old('no_of_vehicles') : $resident->no_of_vehicles}}" class="form-control {{ $errors->has('no_of_vehicles') ? ' is-invalid' : '' }}"
                                            id="no_of_vehicles" placeholder="No of vehicles"> 
                                            @if($errors->has('no_of_vehicles'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('no_of_vehicles') }}</strong>
                                            </span> 
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_types_and_registration_numbers">Vehicle Type and Registration Numbers for Your Vehicles (N/A if no Vehicle).</label>
                                    <textarea class="form-control {{ $errors->has('vehicle_type_and_registration_numbers') ? ' is-invalid' : '' }}" name="vehicle_type_and_registration_numbers" id="vehicle_type_and_registration_numbers"
                                        placeholder="Enter Vehicle Type and Registration Number for all your Vehicles. E.g Toyota Camry 2009 (FGF 234 KJ)">{{old('vehicle_type_and_registration_numbers') ? old('vehicle_type_and_registration_numbers') : $resident->vehicle_type_and_registration_numbers}}</textarea>                                    
                                        @if ($errors->has('vehicle_type_and_registration_numbers'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('vehicle_type_and_registration_numbers') }}</strong>
                                        </span> @endif
                                </div>
                                <button type="submit" class="btn btn-block btn-info">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection