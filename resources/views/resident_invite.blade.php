@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Invite Residents
            </li>
            </ol>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="col-md-6 ">Invite Residents by Emails</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if(session('validEmails'))
                                <div class="alert alert-success" role="alert">
                                    <p>Invite(s) were successfuly sent to the folowing email address(es)</p>
                                    @foreach (session('validEmails') as $validEmail)
                                        <li>{{$validEmail}}</li>
                                    @endforeach
                                </div>
                            @endif
                            @if(session('nonValidEmails'))
                                <div class="alert alert-danger" role="alert">
                                    <p>The folowing email address(es) are Invalid</p>
                                    @foreach (session('nonValidEmails') as $nonValidEmail)
                                        <li>{{$nonValidEmail}}</li>
                                    @endforeach
                                </div>
                            @endif

                            <form class="form" action="/residents/invite" method="POST">
                                <div class="form-body">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>Enter Email</strong></label>
                                        <textarea class="form-control {{ $errors->has('emails') ? ' is-invalid' : '' }}" type="text" name="emails" placeholder="Enter email addresses of the tenants to invite. Separate email addresses by a coma(,)"  required></textarea>
                                        @if ($errors->has('emails'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emails') }}</strong>
                                        </span> 
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="property"><strong>Select property</strong></label>
                                        <select class="form-control {{ $errors->has('property') ? ' is-invalid' : '' }}" name="property" id="property" required>
                                            <option value="">Select Property</option>
                                            @isset($properties)
                                                @foreach ($properties as $property)
                                                <option value="{{$property->id}}"
                                                    {{old('property') ? 'selected' : ''}}>{{$property->address}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @if ($errors->has('property'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('property') }}</strong>
                                        </span> 
                                        @endif
                                    </div>
                                    <br>
                                    <button class="btn btn-sm btn-info pull-right col-md-2">Invite</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection