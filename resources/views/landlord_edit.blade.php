@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/landlords-profile')}}">Landlord Profile</a>
            </li>
            <li class="breadcrumb-item active">Edit Profile
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class=" col-md-6">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <div class="card-block">
                            <form method="POST" action="{{url('/landlords-profile/'. $landlord->id)}}">
                                <div class="form-group">
                                    <label for="fullname">Enter Full Name (Landlord)</label>
                                    <input type="text" name="fullname" value="{{old('fullname') ? old('fullname') : $landlord->fullname}}" class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                        id="fullname" placeholder="Enter Full Name">
                                         @if($errors->has('fullname'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fullname') }}</strong>
                                        </span> 
                                        @endif
                                </div>
                                @method('PUT') @csrf
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $landlord->phone}}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        id="phone" placeholder="Enter Phone no."> 
                                        @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{old('email') ? old('email') : $landlord->email}}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        id="email" placeholder="Enter Email address."> 
                                        @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> 
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="address">Contact Address</label>
                                    <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="address"
                                        placeholder="Enter Contact Address no.">{{old('address') ? old('address') : $landlord->address}}</textarea>                                    
                                        @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="current_residential_address">Current Residential Address</label>
                                    <textarea class="form-control {{ $errors->has('current_residential_address') ? ' is-invalid' : '' }}" name="current_residential_address" id="current_residential_address"
                                        placeholder="Enter Residential Address no.">{{old('current_residential_address') ? old('current_residential_address') : $landlord->current_residential_address}}</textarea>                                    
                                        @if ($errors->has('current_residential_address'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current_residential_address') }}</strong>
                                        </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" name="occupation" value="{{ old('occupation') ? old('occupation') : $landlord->occupation}}" class="form-control {{ $errors->has('occupation') ? ' is-invalid' : '' }}"
                                        id="occupation" placeholder="Enter Your Occupation.">                    
                                        @if ($errors->has('occupation'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('occupation') }}</strong>
                                        </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="office_address">Office Address</label>
                                    <textarea class="form-control {{ $errors->has('office_address') ? ' is-invalid' : '' }}" name="office_address" id="office_address"
                                        placeholder="Enter Office Address no.">{{old('office_address') ? old('office_address') : $landlord->office_address}}</textarea>                                    
                                        @if ($errors->has('office_address'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('office_address') }}</strong>
                                        </span> @endif
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="agree" class="form-check-input {{ $errors->has('agree') ? ' is-invalid' : '' }}" id="agree">
                                    <label class="form-check-label" for="agree">I agree to Terms</label> @if($errors->has('agree'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agree') }}</strong>
                                        </span> @endif
                                </div>
                                <button type="submit" class="btn btn-info btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection