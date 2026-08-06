@extends('layouts.layout')
@section('title', 'GAD | Edit Panel')
@section('content')
<section class="content-header">
    <h1> PAGE PANEL SETUP </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{{ route('gender.route',['path' => 'gender-and-development-page-setup','action' => 'gender-retrieve-panel','id' => encrypt($GenderNavBarDetails->detail_id)]) }}"><i class="fa fa-folder-o"></i> Manage Page {{ ucfirst(strtolower($GenderNavBarDetails->detail_name)) }} </a></li>
        <li class="active"><i class="fa fa-folder-o"></i> Edit Panel </li>
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
                            <li><a href="{{ route('gender.route',['path' => $path,'action' => 'gender-retrieve-panel','id' => encrypt($GenderNavBarDetails->detail_id)]) }}"><b> <i class="fa fa-list"></i> ALL PANEL </b></a></li>
                            <li class="active"><a href="#edit" data-toggle="tab"><b> <i class="fa fa-plus"></i> EDIT PANEL </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="edit"> 
                            @include('pages.admin.gender.forms.formeditpanel',['GenderPanel' => $GenderPanel])
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection