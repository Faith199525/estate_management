@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/residents')}}">All Residents</a>
            </li>
            <li class="breadcrumb-item active">Add Resident
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header">Add Resident</h4>

                <div class="card-body">
                    <div class="card-block">
                        @if (auth()->user()->hasPermission('edit_resident'))
                        <form action="/admin/residents/add" method="POST">
                            <div class="card">
                                <strong class="text-center" style="margin-top:1em;">Landlord Section</strong>
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="form-group">
                                            <label for="landlord_fullname">Enter Full Name (Landlord)</label>
                                            <input type="text" name="landlord_fullname" value="{{old('landlord_fullname') ? old('landlord_fullname') : $landlord->fullname}}" class="form-control {{ $errors->has('landlord_fullname') ? ' is-invalid' : '' }}"
                                                id="landlord_fullname" placeholder="Enter Full Name">
                                                @if($errors->has('landlord_fullname'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('landlord_fullname') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="landlord_phone">Phone</label>
                                                <input type="text" name="landlord_phone" value="{{ old('landlord_phone') ? old('landlord_phone') : $landlord->phone}}" class="form-control {{ $errors->has('landlord_phone') ? ' is-invalid' : '' }}"
                                                    id="landlord_phone" placeholder="Enter Phone no.">
                                                    @if ($errors->has('landlord_phone'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('landlord_phone') }}</strong>
                                                    </span> @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="landlord_email">Email</label>
                                                <input type="email" name="landlord_email" value="{{old('landlord_email') ? old('landlord_email') : $landlord->email}}" class="form-control {{ $errors->has('landlord_email') ? ' is-invalid' : '' }}"
                                                    id="landlord_email" placeholder="Enter Email address.">
                                                    @if($errors->has('landlord_email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('landlord_email') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="landlord_address">Contact Address</label>
                                            <textarea class="form-control {{ $errors->has('landlord_address') ? ' is-invalid' : '' }}" name="landlord_address" id="landlord_address"
                                                placeholder="Enter Contact Address no.">{{old('landlord_address') ? old('landlord_address') : $landlord->address}}</textarea>
                                                @if ($errors->has('landlord_address'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('landlord_address') }}</strong>
                                                </span> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <strong class="text-center" style="margin-top:1em;">Resident Section</strong>
                                <div class="card-body">
                                    <div class="card-block">

                                        <div class="form-group row">
                                            <div class="col-md-6">

                                                <label for="house_no">House No</label>
                                                <input type="text" class="form-control {{ $errors->has('house_no') ? ' is-invalid' : '' }}" name="house_no" id="house_no"
                                                    value="{{old('house_no')}}" placeholder="Enter house no."> @if ($errors->has('house_no'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('house_no') }}</strong>
                                            </span> @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="street_id"> Select Street</label>
                                                <select class="form-control {{ $errors->has('street_id') ? ' is-invalid' : '' }}" name="street_id" id="street_id">
                                                    <option value="">Select Street</option>
                                                    @isset($streets)
                                                        @foreach ($streets as $street)
                                                        <option value="{{$street->id}}" {{(old('street_id') == $street->id) ? 'selected' : ''}}>{{$street->details}}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>

                                                @if ($errors->has('street_id'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street_id') }}</strong>
                                            </span> @endif
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="fullname">Enter Full Name</label>
                                            <input type="text" name="fullname" value="{{old('fullname') ? old('fullname') : $resident->fullname}}" class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                                id="fullname" placeholder="Enter Resident Full Name">
                                                @if($errors->has('fullname'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('fullname') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        @csrf
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
                                                    id="dob" placeholder="Enter Resident DOB">
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
                                                id="occupation" placeholder="Enter Resident Occupation">
                                                @if($errors->has('occupation'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('occupation') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="office_address">Office Address</label>
                                            <textarea class="form-control {{ $errors->has('office_address') ? ' is-invalid' : '' }}" name="office_address" id="office_address"
                                                placeholder="Enter Resident Office Address">{{old('office_address') ? old('office_address') : $resident->office_address}}</textarea>
                                                @if ($errors->has('office_address'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('office_address') }}</strong>
                                                </span> @endif
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="marital_status">Marital Status</label>
                                            <input type="text" name="marital_status" value="{{old('marital_status') ? old('marital_status') : $resident->marital_status}}" class="form-control {{ $errors->has('marital_status') ? ' is-invalid' : '' }}"
                                                id="marital_status" placeholder="Enter Resident Marital Status">
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
                                                    id="spouse_occupation" placeholder="Resident Spouse's Occupation. (Write Not Applicable if Single)">
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
                                            <label for="vehicle_types_and_registration_numbers">Vehicle Type and Registration Numbers for Resident Vehicles (N/A if no Vehicle).</label>
                                            <textarea class="form-control {{ $errors->has('vehicle_type_and_registration_numbers') ? ' is-invalid' : '' }}" name="vehicle_type_and_registration_numbers" id="vehicle_type_and_registration_numbers"
                                                placeholder="Enter Vehicle Type and Registration Number for all Resident Vehicles. E.g Toyota Camry 2009 (FGF 234 KJ)">{{old('vehicle_type_and_registration_numbers') ? old('vehicle_type_and_registration_numbers') : $resident->vehicle_type_and_registration_numbers}}</textarea>
                                                @if ($errors->has('vehicle_type_and_registration_numbers'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('vehicle_type_and_registration_numbers') }}</strong>
                                                </span> @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary"><strong> Add new Resident</strong></button>
                        </form>
                        @else
                        <h3>You do not have the required Permission. Kindy contact admin.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
