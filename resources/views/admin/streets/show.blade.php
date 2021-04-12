@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/streets')}}">All Streets</a>
            </li>
            <li class="breadcrumb-item active">Street
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
                        <div class="col-md-4 ">Street</div>
                        @if (auth()->user()->hasPermission('edit_street'))
                        <div class="col-md-6 ">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                Edit Street
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModalDelete">
                                Delete Street
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                    @isset($street)
                        <span><strong>Street Name: </strong>{{$street->details}}</span><br>
                    @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->hasPermission('edit_street'))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Edit Street</h5>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/admin/streets/' . $street->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="details">Street Name</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Enter street address. E.g Embassy close, Off Association Road" name="details" id="details">{{old('details') ? old('details') : $street->details}}</textarea>
                                @if ($errors->has('details'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Delete Modal -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabelDelete">Delete Street</h5>
            </div>
            <div class="modal-body">
                <div>
                    <p class="text-danger text-center">Are You really sure you want to delete this Street?</p>
                    <form method="POST" action="{{url('/admin/streets/' . $street->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="details">Street Name</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Enter street address. E.g Embassy close, Off Association Road" name="details" id="details" readonly>{{old('details') ? old('details') : $street->details}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Delete Street</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
