@extends('layouts.layout')
@section('title', 'GAD | Page Setup')
@section('content')
<section class="content-header">
    <h1> PAGE SETUP </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active"><i class="fa fa-folder-o"></i> Page Setup </li>
    </ol>
</section>
<section class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body" id="users_box" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: white;">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span>
                        <label><a href="{{ route('gender.route',['path' => $path]) }}"> PAGE SETUP </a></label> 
                    </h3>
                </div>
                <div class="panel-body">
                    @include('pages.admin.gender.includes.tablepagesetup')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection