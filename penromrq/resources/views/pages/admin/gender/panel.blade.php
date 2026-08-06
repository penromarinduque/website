@extends('layouts.layout')
@section('title', 'GAD | Manage Page Setup')
@section('content')
<section class="content-header">
    <h1> PAGE PANEL SETUP </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{{ route('gender.route',['path' => 'gender-page-setup']) }}"><i class="fa fa-folder-o"></i> Page Setup </a></li>
        <li class="active"><i class="fa fa-folder-o"></i> Manage Page Setup </li>
    </ol>
</section>
<section class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: white;">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span>
                        <label><a href="{{ route('gender.route',['path' => $path]) }}"> PAGE SETUP </a></label> 
                        <span class="fa fa-angle-double-right fa-fw"></span>
                        <label> MANAGE PANELS </label>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="nav-tabs-custom"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#allpanel" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL PANEL </b></a></li>
                            <li><a href="#newpanel" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD NEW PANEL </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="allpanel">
                            @include('pages.admin.gender.includes.tablepanel')
                        </div>
                        <div class="tab-pane fade" id="newpanel"> 
                            @include('pages.admin.gender.forms.formaddpanel')
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@include('pages.admin.gender.script.pagescript')
@endsection