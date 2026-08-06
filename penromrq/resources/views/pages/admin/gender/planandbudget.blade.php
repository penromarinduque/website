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
                            <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL PLAN </b></a></li>
                            <li><a href="#edit" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD PLAN </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="list">
                            @include('pages.admin.gender.includes.tableplanandbudget')
                        </div>
                        <div class="tab-pane fade" id="edit">
                            @include('pages.admin.gender.forms.formaddplanandbudget')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('pages.admin.gender.modal.modalplanandbudget')
@include('pages.admin.gender.script.pagescript')
@endsection