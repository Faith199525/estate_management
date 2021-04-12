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
            <li class="breadcrumb-item active">Property
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class=" col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <h4 class="card-title">Property</h4>
                            <a href="/properties/{{$property->id}}/edit" class="btn btn-sm btn-info pull-right">Edit</a>
                            <form class="pull-right" action="/properties/{{$property->id}}" onsubmit="return confirm('Do you really want to delete this property?')" method="post">
                                @csrf()
                                @method('DELETE')
                                <button class="pull-right btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>                            
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>House No:</strong> {{$property->house_no}}
                            </li>
                            <li class="list-group-item">
                                <strong>Address:</strong> {{ucwords($property->address)}}
                            </li>
                            <li class="list-group-item">
                                <strong>Buiding Type:</strong> {{ucwords($property->building_type)}}
                            </li>
                            <li class="list-group-item">
                                <strong>No of Appartments:</strong> {{$property->no_of_apartments}}
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <h4 class="card-title">Residents</h4>
                        </div>
                    </div>
                </div>
                @if($property->residents)
                    @foreach($property->residents as $resident)
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                
                                @if ($resident->photo)
                                <div class="text-xs-center media-left media-middle">
                                    <img src="{{$resident->photo? url($resident->photo) : ''}}" width="120" height="120" alt="">
                                </div>
                                @else
                                <div class="p-2 text-xs-center bg-cyan media-left media-middle">
                                    <i class="icon-user1 font-large-4 white"></i>
                                </div>
                                @endif
                                
                                <div class="p-2 media-body">
                                    <h5 class="cyan">{{$resident->fullname}}</h5>
                                    <h5 class="text-bold-400">{{$resident->phone}}</h5>
                                    <h5 class="text-bold-400">{{$resident->email}}</h5>
                                </div>
                                <div class="p-2 text-xs-center bg-cyan media-right media-middle">
                                    <a href="/properties/{{$property->id}}/residents/{{$resident->id}}" class="text-white">View Details</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
