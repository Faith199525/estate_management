@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/landlords')}}">All Landlords</a>
            </li>
            <li class="breadcrumb-item active">Invite Landlords
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
                        <div class="col-md-6 ">Invite Landlords by Emails</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="col-md-10 ">
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

                            @if (auth()->user()->hasPermission('edit_landlord'))
                            <form class="" action="/admin/landlords/invite" method="POST">
                                <div class="form-group">

                                    @csrf
                                    <h3>Enter Emails</h3>
                                    <textarea class="col-md-10 form-control" type="text" name="emails" placeholder="Enter email addresses of the landords to invite. Separate email addresses by a coma(,)"  ></textarea>
                                    <br>
                                    <button class="btn btn-sm btn-primary pull-right col-md-2">Invite</button>
                                </div>
                            </form>
                            @else
                            <h3>You do not have the required permission. Kindly contact Admin.</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
