@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="content-header row">
        <div class="content-header-left breadcrumbs-left breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/admin/dues')}}">All Dues</a>
            </li>
            <li class="breadcrumb-item active">Due
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
                        <div class="col-md-4 ">Due</div>
                        @if (auth()->user()->hasPermission('edit_due'))
                        <div class="col-md-6 ">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                Edit Due
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModalDelete">
                                Delete Due
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                    @isset($due)
                        <span><strong>Name: </strong>{{$due->name}}</span><br>
                        <span><strong>Description: </strong>{{$due->details}}</span><br>
                        <span><strong>Type: </strong>{{ ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/'," $1",$due->type)) }}</span><br>
                        <span><strong>Payer: </strong>{{ ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/'," $1",$due->payer)) }}</span><br>
                        <span><strong>Amount: </strong>₦ {{number_format($due->amount/100)}}</span><br>
                    @endisset
                    </div>
                </div>
            </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Due</h5>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="{{url('/admin/dues/' . $due->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name') ? old('name') : $due->name}}" placeholder="Enter a name for this due e.g Security Dues" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="details">Description</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Explain what this due is for. E.g This Dues is for Tenant Residents" name="details" id="details">{{old('details') ? old('details') : $due->details}}</textarea>
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
                                        <option value="{{$typeKey}}" {{old('type')? (old('type') == $typeKey) ? 'selected' : '' :       ($due->type == $typeKey) ? 'selected' : ''}}>{{$typeValue}}</option>
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
                                        <option value="{{$payerKey}}"  {{old('payer')? (old('payer') == $payerKey) ? 'selected' : '' :       ($due->payer == $payerKey) ? 'selected' : ''}}>{{$payerValue}}</option>
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
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" value="{{old('amount') ? old('amount') :( $due->amount / 100)}}" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="Enter Due Amount">
                            @if ($errors->has('amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Update Due</button>
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
                <h5 class="modal-title" id="exampleModalLabelDelete">Delete Due</h5>
            </div>
            <div class="modal-body">
                <div>
                    <p class="text-danger text-center">Are You really sure you want to delete this Due?</p>
                    <form method="POST" action="{{url('/admin/dues/' . $due->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name') ? old('name') : $due->name}}" placeholder="Enter a name for this due e.g Security Dues" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="details">Description</label>
                            <textarea type="text" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" placeholder="Explain what this due is for. E.g This Dues is for Tenant Residents" name="details" id="details" readonly>{{old('details') ? old('details') : $due->details}}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="type">Type</label>
                                <select name="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" readonly>
                                    <option value="">Select Due Type</option>
                                    @if($dueTypes = \App\Essentials\DueType::getArray())
                                        @foreach ($dueTypes as $typeKey => $typeValue)
                                        <option value="{{$typeKey}}" {{old('type')? (old('type') == $typeKey) ? 'selected' : '' :       ($due->type == $typeKey) ? 'selected' : ''}}>{{$typeValue}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="payer">Paid By</label>
                                <select name="payer" class="form-control {{ $errors->has('payer') ? ' is-invalid' : '' }}" readonly>
                                    <option value="">Select Payer</option>
                                    @if($duePayer = \App\Essentials\DuePayer::getArray())
                                        @foreach ($duePayer as $payerKey => $payerValue)
                                        <option value="{{$payerKey}}"  {{old('payer')? (old('payer') == $payerKey) ? 'selected' : '' :       ($due->payer == $payerKey) ? 'selected' : ''}}>{{$payerValue}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" value="{{old('amount') ? old('amount') :( $due->amount / 100)}}" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="Enter Due Amount" readonly>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Delete Due</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
