@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Properties
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header">Properties
                        <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#newPropertyModal">Add New Property</button>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Building Type</th>
                                            <th scope="col">No of Appartments</th>
                                            <th scope="col">Residents</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($properties) @foreach ($properties as $key => $property)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{ucwords($property->address)}}</td>
                                            <td>{{ucwords($property->building_type)}}</td>
                                            <td>{{$property->no_of_apartments}}</td>
                                            <td><span class="tag tag-default tag-pill bg-info float-xs-right">{{$property->residents ?$property->residents->count() : 'Nil'}}</span></td>
                                            <td>
                                                <a href="/properties/{{$property->id}}" class="btn btn-sm btn-info">View</a>
                                                <a href="/properties/{{$property->id}}/edit" class="btn btn-sm btn-success">Edit</a>
                                                <form action="/properties/{{$property->id}}" onsubmit="return confirm('Do you really want to delete this property?')" method="post">
                                                    @csrf()
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>danger
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
</div>

<!-- Modal -->
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
