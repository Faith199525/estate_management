@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Users
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
                        <div class="col-md-6 ">Dashboard</div>
                        <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter name or email address" class="form-control pull-right">
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
                                        <th scope="col">Name</th>
                                        @if (auth()->user()->hasPermission('view_user'))
                                        <th scope="col">Email</th>
                                        @endif
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($users) @foreach ($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{$key + $users->firstItem()}}</th>
                                        <td>{{$user->name}}</td>
                                        @if (auth()->user()->hasPermission('view_user'))
                                        <td>{{$user->email}}</td>
                                        @endif
                                        <td><a href="{{url('/admin/users/'.$user->id)}}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($users)
            {{ $users->links() }}
            @endisset
        </div>
    </div>
</div>
@endsection
