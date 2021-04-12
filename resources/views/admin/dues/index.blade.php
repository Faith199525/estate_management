@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">All Dues
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
                        <div class="col-md-4 ">Estate Dues</div>
                        <div class="col-md-6 ">
                            <form class="" action="">
                                <div class="row">
                                    <input class="col-md-10" type="text" name="q" placeholder="Enter due name" class="form-control pull-right">
                                    <button class="btn btn-sm btn-primary col-md-2">Search</button>
                                </div>
                            </form>
                        </div>
                        @if (auth()->user()->hasPermission('edit_due'))
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New Due
                            </button>
                        </div>
                        @endif
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
                                        <th scope="col">Description</th>
                                        <th scope="col">Due Type</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($dues) @foreach ($dues as $key => $due)
                                    <tr>
                                        <th scope="row">{{$key + $dues->firstItem()}}</th>
                                        <td>{{$due->name}}</td>
                                        <td>{{$due->details}}</td>
                                        <td>{{ ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/'," $1",$due->type)) }}</td>
                                        <td>₦ {{number_format($due->amount / 100)}}</td>
                                        <td><a href="{{url('/admin/dues/'.$due->id)}}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @endforeach @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($dues)
            {{ $dues->links() }}
            @endisset
        </div>
    </div>
</div>
@if (auth()->user()->hasPermission('edit_due'))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Add New Due</h5>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/admin/dues')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" placeholder="Enter a name for this due e.g Security Dues" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="details">Description</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Explain what this due is for. E.g This Dues is for Tenant Residents" name="details" id="details">{{old('details')}}</textarea>
                                @if ($errors->has('details'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="type">Type</label>
                                <select name="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}">
                                    <option value="">Select Due Type</option>
                                    @if($dueTypes = \App\Essentials\DueType::getArray())
                                        @foreach ($dueTypes as $typeKey => $typeValue)
                                        <option value="{{$typeKey}}" {{(old('type') == $typeKey) ? 'selected' : ''}}>{{$typeValue}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="payer">Paid By</label>
                                <select name="payer" class="form-control {{ $errors->has('payer') ? ' is-invalid' : '' }}">
                                    <option value="">Select Payer</option>
                                    @if($duePayer = \App\Essentials\DuePayer::getArray())
                                        @foreach ($duePayer as $payerKey => $payerValue)
                                        <option value="{{$payerKey}}" {{(old('payer') == $payerKey) ? 'selected' : ''}}>{{$payerValue}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('payer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('payer') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount (₦)</label>
                            <input type="text" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="Enter Due Amount">
                            @if ($errors->has('amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Add Due</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
