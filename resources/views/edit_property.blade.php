@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/properties')}}">All Properties</a>
            </li>
            <li class="breadcrumb-item active">Edit Property
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class=" col-md-6">
                <div class="card">
                    <h4 class="card-header">Edit Property
                    </h4>
                    <div class="card-body">
                        <div class="card-block">
                            <form method="POST" action="{{url('/properties/'. $property->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="house_no">House No</label>
                                    <input type="text" class="form-control {{ $errors->has('house_no') ? ' is-invalid' : '' }}" name="house_no" id="house_no"
                                        value="{{old('house_no') ? old('house_no') : $property->house_no }}" placeholder="Enter house no."> @if ($errors->has('house_no'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('house_no') }}</strong>
                                </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="street_id"> Select Street</label>
                                    <select class="form-control {{ $errors->has('street_id') ? ' is-invalid' : '' }}" name="street_id" id="street_id">
                                        <option value="">Select Street</option>
                                        @isset($streets)
                                            @foreach ($streets as $street)
                                            <option value="{{$street->id}}" 
                                                
                                                @if (old('street_id'))
                                                    @if (old('street_id') == $street->id)
                                                        selected
                                                    @else

                                                    @endif
                                                @else
                                                    @if ($property->street_id == $street->id)
                                                        selected
                                                    @else

                                                    @endif
                                                @endif
                                                >{{$street->details}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
        
                                    @if ($errors->has('street_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('street_id') }}</strong>
                                </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="zone">Zone</label>
                                    <select name="zone" class="form-control {{ $errors->has('zone') ? ' is-invalid' : '' }}">
                                        <option value="">Select Zone</option>
                                        @if($zones = \App\Essentials\Zone::getArray())
                                            @foreach ($zones as $zoneKey => $zoneValue)
                                            <option value="{{$zoneKey}}" {{old('zone')? (old('zone') == $zoneKey) ? 'selected' : '' :       ($property->zone == $zoneKey) ? 'selected' : ''}}>{{$zoneValue}}</option>
                                            @endforeach
                                        @endif




                                        {{--  @if($zones = \App\Essentials\Zone::getArray())
                                            @foreach ($zones as $zoneKey => $zoneValue)
                                            <option value="{{$zoneKey}}" {{(old('zone') == $zoneKey) ? 'selected' : ''}}>{{$zoneValue}}</option>
                                            @endforeach
                                        @endif  --}}
                                    </select>
                                    @if ($errors->has('zone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zone') }}</strong>
                                    </span> 
                                    @endif


                                    {{--  <input type="text" name="zone" value="{{ old('zone') ? old('zone') : $property->zone }}" class="form-control {{ $errors->has('zone') ? ' is-invalid' : '' }}"
                                        id="zone" placeholder="Enter zone"> @if ($errors->has('zone'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('zone') }}</strong>
                                </span> @endif  --}}
                                </div>
                                <div class="form-group">
                                    <label for="building_type">Building Type</label>
                                    <select class="form-control {{ $errors->has('building_type') ? ' is-invalid' : '' }}" name="building_type" id="building_type">
                                <option value="">Select Building Type</option>
                                <option value="bungalow" {{(old('building_type') == 'bungalow')? 'selected' : ($property->building_type == 'bungalow' ? 'selected' : '')}}>Bungalow</option>
                                <option value="duplex" {{(old('building_type') == 'duplex')? 'selected' : ($property->building_type == 'duplex' ? 'selected' : '')}}>Duplex</option>
                                <option value="block of flats" {{(old('building_type') == 'block of flats')? 'selected' : ($property->building_type == 'block of flats' ? 'selected' : '')}}>Block of Flats</option>
                            </select> @if ($errors->has('building_type'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('building_type') }}</strong>
                                </span> @endif
                                </div>
                                <div class="form-group">
                                    <label for="no_of_apartments">No of Apartments</label>
                                    <input type="number" name="no_of_apartments" value="{{old('no_of_apartments') ? old('no_of_apartments') : $property->no_of_apartments }}" class="form-control {{ $errors->has('no_of_apartments') ? ' is-invalid' : '' }}">                            @if ($errors->has('no_of_apartments'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('no_of_apartments') }}</strong>
                                </span> @endif
                                </div>
                                <button type="submit" class="btn btn-info btn-block ">Update Property</button>
                            </form>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection