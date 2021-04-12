@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="pink">{{\App\Property::count()}}</h3>
                                    <span>Properties</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-home2 pink font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="teal">{{\App\Resident::count()}}</h3>
                                    <span>Residents</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="deep-orange">{{\App\Incident::count()}}</h3>
                                    <span>Incidents</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="cyan">{{\App\Visitor::whereYear('created_at', date('Y'))->count()}}</h3>
                                    <span>Visitors ({{date('Y')}})</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-slideshare cyan font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <div class="card-block">
                            You are Welcome to Admin!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
