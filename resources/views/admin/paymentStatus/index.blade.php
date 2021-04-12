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
                        <div class="col-md-6 ">Import Excel</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">

                        @if (session()->has('failures'))

                        <div class="alert alert-danger">
                        <h3>There were errors in excel upload, pls make changes and upload only the error rows that were not uploaded before</h3>
                        </div>

                        <table class="table table-danger">
                        <tr>
                        <th>Row</th>
                        <th>Attribute</th>
                        <th>Errors</th>
                        <th>Value</th>
                        </tr>
                        @foreach (session()->get('failures') as $validation)
                            <tr>
                                <td>{{$validation->row()}}</td>
                                <td>{{$validation->attribute()}}</td>
                                <td>
                                <!-- <ul> -->
                                    @foreach ($validation->errors() as $e)
                                    {{ $e}}
                                    <!-- <li>{{ $e }}</li> -->
                                    @endforeach
                                <!-- </ul> -->
                                </td>
                                <td>{{ $validation->values()[$validation->attribute()] }}</td>
                            </tr>
                        @endforeach
                        </table>

                        @endif

                        <form action="{{ url('/admin/import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        Select excel file to upload
                        <br><br>

                        <input type="file" name="file" id="file">
                        <br><br>
                        <button type="submit"> Upload File</button>

                        <br><br><br>
                        <a href="{{ url('/download/sample/excel.xlsx') }}">Download Sample</a>
                        </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
