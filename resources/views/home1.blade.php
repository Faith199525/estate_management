@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('snipets.side_nav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>

                @include('snipets.alerts')
                <div class="card-body">

                    You are Welcome!
                    @if (\Auth::user()->landlord && \Auth::user()->residents->isEmpty())
                        <span> To Activate a Resident Profile for the Landlord, 
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Click Here</button>
                        </span>
                        <br>
                        <br>
                        <small><strong>Note:</strong> Activating a Resident Profile for the Landlord means, the landlord resides within the estate.</small>
                    @endif  
        
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
                <h5 class="modal-title" id="exampleModalLabel">Activate Resident Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/activate-resident-profile')}}">
                        @csrf

                        <div class="form-group">
                            <label for="property_id"> Select Property</label>
                            <select class="form-control {{ $errors->has('property_id') ? ' is-invalid' : '' }}" name="property_id" id="property_id">
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


                        <button type="submit" class="btn btn-primary btn-block btn-sm">Activate Resident Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
