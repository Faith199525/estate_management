@extends('layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Visitors
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
                        <h3 class="blue text-md-center mb-2">New Visitor Notification</h3>
                        <p>This is where you notify the security that you are expecting a visitor.</p>
                        <form method="POST" action="{{url('/visitors')}}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" placeholder="Visitor Name" name="name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="expected_date">Date Expected</label>
                                <input type="date" class="form-control" placeholder="" name="expected_date" value="{{old('expected_date')}}">
                                @if ($errors->has('expected_date'))
                                <span class="invalid-feedback" role="alert">
                                {{ $errors->first('expected_date') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="details"> Visitor Details</label>
                                <textarea rows="6" type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details"
                                    placeholder="Enter visitor details and what S/he is coming to do. You can also leave instructions">{{old('details')}}</textarea>
                                @if ($errors->has('details'))
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $errors->first('details') }}</span>
                                </sp>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send Visitor Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 ">Visitors</div>
                        {{-- <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter visitor name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                New Visitor Notification
                            </button>
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
                                        <th scope="col">name</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Date Expected</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($visitors) @foreach ($visitors as $key => $visitor)
                                    <tr>
                                        <th scope="row">{{$key + $visitors->firstItem()}}</th>
                                        <td>{{$visitor->name}}</td>
                                        <td>{{$visitor->details}}</td>
                                        <td>{{$visitor->expected_date}}</td>
                                        <td>{{$visitor->status}}</td>
                                        {{-- <td><a href="{{url('/admin/visitors/'.$visitor->id)}}" class="btn btn-sm btn-primary">View</a> --}}
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($visitors)
            {{ $visitors->links() }}
            @endisset
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Visitor Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/visitors')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Visitor Name" name="name" value="{{old('name')}}">
                            {{ $errors->first('name') }}
                        </div>
                        <div class="form-group">
                            <label for="expected_date">Date Expected</label>
                            <input type="text" class="form-control" placeholder="Visitor Name" name="expected_date" value="{{old('expected_date')}}">
                            {{ $errors->first('expected_date') }}
                        </div>
                        <div class="form-group">
                            <label for="details"> Visitor Details</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details"
                                placeholder="Enter visitor address. E.g The transformer fuse is now bad">{{old('details')}}</textarea> @if ($errors->has('details'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('details') }}</strong>
                        </span> @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Send Visitor Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
