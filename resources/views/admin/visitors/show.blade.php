@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/visitors')}}">All Visitors</a>
            </li>
            <li class="breadcrumb-item active">Visitor
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
                        <div class="col-md-4 "><strong>Visitor's Details </strong></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                    @isset($visitor)
                        <span><strong>Visit Status: </strong><span class="btn btn-sm btn-outline-success">{{$visitor->status ? $visitor->status : 'Yet to Arrive'}}</span></span><br>
                        <span><strong>Date Created: </strong>{{$visitor->created_at}}</span><br>
                        <span><strong>Visitor's Name: </strong>{{$visitor->name}}</span><br>
                        <span><strong>Visitor Details: </strong>{{$visitor->details}}</span><br>
                        <span><strong>Arrival Date: </strong>{{$visitor->expected_date}}</span><br>
                        <span><strong>Host: </strong>{{$visitor->user->name}}</span><br>
                        <hr>
                        @if (auth()->user()->hasPermission('edit_visitor'))
                        <form action="/admin/visitors/{{$visitor->id}}/status" class="form-inline" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="status" id="" required>
                                    <option value="">Select Status</option>
                                    <option value="Access Granted" {{$visitor->status == 'Access Granted' ? 'selected' : ''}}>Access Granted </option>
                                    <option value="Staying"{{$visitor->status == 'Staying' ? 'selected' : ''}}>Staying for a while</option>
                                    <option value="Left"{{$visitor->status == 'Left' ? 'selected' : ''}}>Left Estate</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-sm" type="submit">Update Status</button>
                            </div>
                        </form>
                        @endif
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
                    @isset($visitor)
                        <span><strong>Host Name: </strong>{{$visitor->user->name}}</span><br>

                        @if ($visitor->user->residents->isNotEmpty())
                        <span><strong>Address: </strong>{{$visitor->user->residents->first()->property->address}}</span><br>
                        @elseif ($visitor->user->landlord)
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

@endsection
