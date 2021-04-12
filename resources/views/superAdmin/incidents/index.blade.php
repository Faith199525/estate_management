@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Incidents
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 ">Dashboard</div>
                        <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter incident name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        @if (auth()->user()->hasPermission('edit_incident'))
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New Incident
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($incidents) @foreach ($incidents as $key => $incident)
                                    <tr>
                                        <th scope="row">{{$key + $incidents->firstItem()}}</th>
                                        <td>{{$incident->created_at}}</td>
                                        <td>{{$incident->title}}</td>
                                        <td>{{$incident->details}}</td>
                                        <td>{{$incident->status}}</td>
                                        <td><a href="{{url('/admin/incidents/'.$incident->id)}}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($incidents)
            {{ $incidents->links() }}
            @endisset
        </div>
    </div>
</div>

@if (auth()->user()->hasPermission('edit_incident'))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Add Incident</h5>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/admin/incidents')}}">
                        @csrf
                        <div class="form-group">
                            <label for="details"> Incident Name</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details"
                                placeholder="Enter incident details. E.g Old trasformer needs repairs">{{old('details')}}</textarea> @if ($errors->has('details'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('details') }}</strong>
                        </span> @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Add Incident</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
