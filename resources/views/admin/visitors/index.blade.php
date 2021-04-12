@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Visitors
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
                        <div class="col-md-4 ">Visitors</div>
                        <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter visitor name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Added on</th>
                                        <th scope="col">Visitor's Name</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Expected on</th>
                                        <th scope="col">Host</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($visitors) @foreach ($visitors as $key => $visitor)
                                    <tr>
                                        <th scope="row">{{$key + $visitors->firstItem()}}</th>
                                        {{-- {{$visitor}} --}}
                                        <td>{{$visitor->created_at}}</td>
                                        <td>{{$visitor->name}}</td>
                                        <td>{{$visitor->details}}</td>
                                        <td>{{$visitor->expected_date}}</td>
                                        <td>{{$visitor->user->name}}</td>
                                        <td>{{$visitor->status}}</td>
                                        <td><a href="{{url('/admin/visitors/'.$visitor->id)}}" class="btn btn-sm btn-primary">View</a>
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

@endsection
