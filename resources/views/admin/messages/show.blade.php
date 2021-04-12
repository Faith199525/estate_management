@extends('admin.layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/messages')}}">All Messages</a>
            </li>
            <li class="breadcrumb-item active">Message
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
                        <div class="col-md-4 ">Message</div>
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="card-block">
                    @isset($message)
                        <span><strong>Sent By: </strong>{{$message->user->name}}</span><br>
                        <span><strong>Channel: </strong>{{$message->channel}}</span><br>
                        <span><strong>Recepient: </strong>{{$message->recepient}}</span><br>
                        <span><strong>Message: </strong>{{$message->content}}</span><br>
                        <span><strong>Date: </strong>{{$message->created_at}}</span><br>
                    @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection