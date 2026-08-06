@extends('layouts.layout')
@section('title', 'GAD | ' . $GenderPanel->panel_name)
@section('content')
<section class="content-header">
    @include('pages.admin.gender.includes.breadcrumb')
</section>
<section class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: white;">
                    @include('pages.admin.gender.includes.panelheading')
                </div>
                <div class="panel-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-retrieve-panel-details','id' => encrypt($GenderPanel->panel_id) ]) }}"><b> <i class="fa fa-list"></i> ALL REPORT </b></a></li>
                            <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD REPORT </b></a></li>
                            <li class="active"><a href="#edit" data-toggle="tab"><b> <i class="fa fa-edit"></i> EDIT REPORT </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="add">
                            @include('pages.admin.gender.forms.formaddminutesmeeting')
                        </div>
                        <div class="tab-pane fade active in" id="edit">
                            @include('pages.admin.gender.forms.formeditminutesmeeting')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('pages.admin.gender.script.pagescript')
@endsection