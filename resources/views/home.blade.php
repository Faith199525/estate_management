@extends('layouts.app')
@section('title')

<title>Home - {{ settings('app.name', 'ERMS') }} Management System</title>

@endsection
@section('content')

    <div class="row">
    @if (\Auth::user()->landlord)
        <div class="offset-sm-3 col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink">{{\Auth::user()->properties->count()}}</h3>
                                <span>Properties</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-home2 pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="teal">{{\Auth::user()->tenants()->count()}}</h3>
                                <span>Residents</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange">64.89 %</h3>
                                <span>Conversion Rate</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="cyan">423</h3>
                                <span>Support Tickets</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-ios-help-outline cyan font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endif
    </div>
{{-- {{session('role.permissions')}} --}}

    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-xs-center">
                    <div class="card-body">
                        <div class="card-block">
                            <h4 class="card-title info">You are Welcome!</h4>
                            <p class="card-text">This is where you manage all that relates to you in {{settings('APP_NAME')}}.</p>
                            <p>You can manage things like Visitor request, incident reporting, dues payment among others. <br>
                                <a href="/guide">Click here</a> for a detailed guide
                            </p>
                            @if (\Auth::user()->landlord && \Auth::user()->residents->isEmpty())
                            <br>
                            @if(\Auth::user()->properties->isEmpty())
                            <h4>Quick Steps to get started</h4>
                            <p>Click <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#newPropertyModal">Add New Property</button> to register your property.</p>
                            @endif
                            <p class="card-text">To Activate a Resident Profile for yourself as a Landlord,
                                <button class="btn btn-sm btn-info {{\Auth::user()->properties->isEmpty() ? 'disabled' : ''}}" type="button" data-toggle="modal" data-target="#exampleModal">Click Here</button>
                            </p>
                            <span class="pink"><strong>Note:</strong> Activating a Resident Profile for yourself as a Landlord means, that you reside within the estate.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <h4 class="card-title text-xs-center"><span class="info"> Setup Status</span>
                                {{-- <small>(30% complete)</small> --}}
                            </h4>

                            @isset($profileStatus)
                            <ul class="list-unstyled">
                                <li><i class="icon-check info"></i> Register an account</li>

                                @isset ($profileStatus['isLandlord'])
                                <li>
                                    @isset ($profileStatus['landlordProfileCompleted'])
                                    <i class="icon-check info"></i>Complete Landlord profile
                                    @else
                                    <i class="icon-circle-o"></i><a style="color:#37383c" href="/landlords-profile/edit"> Complete Landlord profile</a>
                                    @endisset
                                </li>
                                <li>
                                    @isset($profileStatus['hasProperties'])
                                    <i class="icon-check info"></i> Add properties
                                    @else
                                    <i class="icon-circle-o"></i><a data-toggle="modal" data-target="#newPropertyModal"> Add properties</a>
                                    @endisset
                                </li>
                                <li>
                                    @isset($profileStatus['hasResidents'])
                                    <i class="icon-check info"></i> Invite Residents to portal
                                    @else
                                    <i class="icon-circle-o"></i><a style="color:#37383c" href="/residents/invite"> Invite Residents to portal</a>
                                    @endisset
                                </li>
                                <li>
                                    @isset($profileStatus['isResident'])
                                    <i class="icon-check info"></i> Activate Resident Profile (Optional)
                                    @else
                                    <i class="icon-circle-o"></i><a data-toggle="modal" data-target="#exampleModal"> Activate Resident Profile (Optional)</a>
                                    @endisset
                                </li>
                                @endisset

                                @isset ($profileStatus['isResident'])
                                <li>
                                    @isset($profileStatus['residentProfileCompleted'])
                                    <i class="icon-check info"></i> Complete your resident profile
                                    @else
                                    <i class="icon-circle-o"></i><a style="color:#37383c" href="/resident-profile"> Complete your resident profile</a>
                                    @endisset
                                </li>
                                @endisset
                            </ul>
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Activate Resident Profile</h4>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/activate-resident-profile')}}">
                        @csrf

                        <div class="form-group">
                            <label for="property_id">Landord's Residence</label>
                            <select class="form-control {{ $errors->has('property_id') ? ' is-invalid' : '' }}" name="property_id" id="property_id" required>
                                <option value="">Select Property</option>
                                @isset($properties)
                                    @foreach ($properties as $property)
                                    <option value="{{$property->id}}" {{(old('property_id') == $property->id) ? 'selected' : ''}}>{{$property->address}}</option>
                                    @endforeach
                                @endisset
                            </select>

                            @if ($errors->has('property_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('property_id') }}</strong>
                        </span> @endif
                        </div>


                        <button type="submit" class="btn btn-info btn-block btn-sm">Activate Resident Profile</button>
                    </form>
                </div>
                <small class="danger">Activate only if you reside within the estate as a landlord</small>
                <br>
                <small>If you can not find the landlord's residence in the list, <a href="/properties">click here</a> to register it.</small>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newPropertyModal" tabindex="-1" role="dialog" aria-labelledby="newPropertyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="newPropertyModalLabel">Add New House</h5>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/properties')}}">
                        @csrf
                        <div class="form-group">
                            <label for="house_no">House No</label>
                            <input type="text" class="form-control {{ $errors->has('house_no') ? ' is-invalid' : '' }}" name="house_no" id="house_no"
                                value="{{old('house_no')}}" placeholder="Enter house no."> @if ($errors->has('house_no'))
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
                                    <option value="{{$street->id}}" {{(old('street_id') == $street->id) ? 'selected' : ''}}>{{$street->details}}</option>
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
                                    <option value="{{$zoneKey}}" {{(old('zone') == $zoneKey) ? 'selected' : ''}}>{{$zoneValue}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('zone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('zone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="building_type">Building Type</label>
                            <select class="form-control {{ $errors->has('building_type') ? ' is-invalid' : '' }}" name="building_type" id="building_type">
                        <option value="">Select Building Type</option>
                        <option value="bungalow" {{(old('building_type') == 'bungalow')? 'selected' : ''}}>Bungalow</option>
                        <option value="duplex" {{(old('building_type') == 'duplex')? 'selected' : ''}}>Duplex</option>
                        <option value="block of flats" {{(old('building_type') == 'block of flats')? 'selected' : ''}}>Block of Flats</option>
                    </select> @if ($errors->has('building_type'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('building_type') }}</strong>
                        </span> @endif
                        </div>
                        <div class="form-group">
                            <label for="no_of_apartments">No of Apartments</label>
                            <input type="number" name="no_of_apartments" value="{{old('no_of_apartments')}}" class="form-control {{ $errors->has('no_of_apartments') ? ' is-invalid' : '' }}">                            @if ($errors->has('no_of_apartments'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_of_apartments') }}</strong>
                        </span> @endif
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-sm">Add New Property</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@if(session('errors'))
<script type="text/javascript">
    $(window).on('load',function(){
        $('#newPropertyModal').modal('show');
    });
</script>
@endif
@endsection
