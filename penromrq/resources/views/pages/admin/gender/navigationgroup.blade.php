@extends('layouts.layout')
@section('title', 'GAD | Navigation Group')
@section('content')
<section class="content-header">
    <h1> &nbsp; </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active"><i class="fa fa-list"></i> Navigation Group </li>
    </ol>
</section>
<section class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: white;">
                    <h3 class="panel-title pull-left">
                        <label><i class="fa fa-list"></i> NAVIGATION GROUP SETUP </label>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="nav-tabs-custom"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL GROUP </b></a></li>
                            <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD GROUP </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="list"> 
                            @include('pages.admin.gender.includes.tablenavigationgroup')
                        </div>
                        <div class="tab-pane fade" id="add"> 
                            @include('pages.admin.gender.forms.formaddnavigatiogroup')
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@include('pages.admin.gender.script.pagescript')
@endsection