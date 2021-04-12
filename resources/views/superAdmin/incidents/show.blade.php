@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/incidents')}}">All Incidents</a>
            </li>
            <li class="breadcrumb-item active">Incident
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 ">Incident</div>
                        {{-- <div class="col-md-6 ">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                Edit Incident
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModalDelete">
                                Delete Incident
                            </button>
                        </div> --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                    @isset($incident)
                        <span><strong>Date Reported: </strong>{{$incident->created_at}}</span><br>
                        <span><strong>Sent By: </strong><a target="_blank" href="/admin/users/{{$incident->user->id}}">{{$incident->user->name}}</a></span><br>
                        <span><strong>Incident Title: </strong>{{$incident->title}}</span><br>
                        <span><strong>Incident Details: </strong>{{$incident->details}}</span><br>
                    @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Host</strong>
                </div>
                <div class="card-body">
                    <div class="card-block">
                    @isset($incident)
                        <span><strong>Host Name: </strong>{{$incident->user->name}}</span><br>

                        @if ($incident->user->residents->isNotEmpty())
                        <span><strong>Address: </strong>{{$incident->user->residents->first()->property->address}}</span><br>
                        @elseif ($incident->user->landlord)
                        <span><strong>Address: </strong>Non Resident Landlord</span>
                        @else
                        <span><strong>Address: </strong>Non Resident <i> (User does not reside within the estate)</i></span>
                        @endif
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Incident</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/admin/incidents/' . $incident->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="details">Incident Name</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Enter incident address. E.g Embassy close, Off Association Road" name="details" id="details">{{old('details') ? old('details') : $incident->details}}</textarea>
                                @if ($errors->has('details'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
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
                <h5 class="modal-title" id="exampleModalLabelDelete">Delete Incident</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <p class="text-danger text-center">Are You really sure you want to delete this Incident?</p>
                    <form method="POST" action="{{url('/admin/incidents/' . $incident->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="details">Incident Name</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Enter incident address. E.g Embassy close, Off Association Road" name="details" id="details" readonly>{{old('details') ? old('details') : $incident->details}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Delete Incident</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
