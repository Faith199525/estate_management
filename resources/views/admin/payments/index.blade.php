@extends('admin.layouts.app') 
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Payments
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
                        <div class="col-md-4 ">Payments</div>
                        {{--  <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter name or email address" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New Due
                            </button>
                        </div>  --}}
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                    <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Amount (₦)</th>
                                                <th>Channel</th>
                                                <th>Dues</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($payments)
                                                @foreach($payments as $key => $payment)
                                                <tr>
                                                    <td>{{$key + $payments->firstItem()}}</td>
                                                    <td>{{date('d/m/Y', strtotime($payment->created_at))}}</td>
                                                    <td><a href="/admin/users/{{$payment->user->id}}">{{$payment->user->name}}</a></td>
                                                    {{--  <td>{{$payment->due_quantity}}</td>  --}}
                                                    <td>{{number_format($payment->amount / 100)}}</td>
                                                    <td>{{ucwords($payment->channel)}}</td>
                                                    {{--  <td>{{!$payment->created_by ? 'Via Platform' : 'By Admin'}}</td>  --}}
                                                    <td>
                                                        <span class="small">
                                                            @if($dues_paid = json_decode($payment->dues_paid))
                                                                @foreach($dues_paid as $p_due)
                                                                <li>{{$p_due->name}} {{$p_due->quantity > 1 ? ' * ' . $p_due->quantity : ''}} : ₦{{number_format($p_due->amount_paid)}}</li>
                                                                @endforeach
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($p_dmp = json_decode($payment->paystack_dump))
                                                        {{$p_dmp->message == 'Verification successful' ? 'Verified' : 'Not Verified'}}
                                                        @else
                                                        <span class="small">
                                                                Confirmed by 
                                                                @if ($a_user = \App\User::find($payment->created_by))
                                                                    <a href="/admin/users/{{$a_user->id}}">
                                                                        {{$a_user->name}}
                                                                    </a>
                                                                @else
                                                                    Admin
                                                                @endif
                                                        </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($payments)
            {{ $payments->links() }}
            @endisset
        </div>
    </div>
</div>

@endsection