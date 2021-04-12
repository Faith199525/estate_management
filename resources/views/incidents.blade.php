@extends('layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Incidents
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h3 class="blue text-md-center mb-2">Report an  Incident</h3>
                        <p>This is where you report incidents that happen within the community. E.g Security, Safety, Damages among others</p>
                        <form method="POST" action="{{url('/incidents')}}">
                            @csrf
                            <div class="form-group">
                                <label for="title"><strong>Title</strong></label>
                                <input type="text" class="form-control" placeholder="Incident Title" name="title" value="{{old('title')}}">
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $errors->first('title') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="details"><strong>Details</strong></label>
                                <textarea  rows="6" type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details"
                                    placeholder="Enter incident details. E.g The transformer fuse is now bad">{{old('details')}}</textarea>
                                @if ($errors->has('details'))
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $errors->first('details') }}</span>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-block ">Send Incident</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <strong class="col-md-4 ">Incidents you have reported</strong>
                        {{-- <div class="offset-md-2 col-md-6 pull-right">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter incident name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div> --}}
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

@endsection
