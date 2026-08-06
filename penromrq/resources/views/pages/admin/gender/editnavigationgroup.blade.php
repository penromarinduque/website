@extends('layouts.layout')
@section('title', 'GAD | Navigation Group')
@section('content')
<style type="text/css">
	.text-style
	{
		max-width: 150px;
		white-space:nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		cursor: pointer;
	}
</style>
<section class="content-header">
	<h1> &nbsp; </h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> Navigation Group </li>
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
							<li><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL GROUP </b></a></li>
							<li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD GROUP </b></a></li>
							<li class="active"><a href="#edit" data-toggle="tab"><b> <i class="fa fa-edit"></i> EDIT GROUP </b></a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="list">
							@include('pages.admin.gender.includes.tablenavigationgroup')
						</div>
						<div class="tab-pane fade" id="add"> 
						    @include('pages.admin.gender.forms.formaddnavigatiogroup')
						</div>
						<div class="tab-pane active fade in" id="edit">
							@include('pages.admin.gender.forms.formeditnavigationgroup')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('pages.admin.gender.script.pagescript')
@endsection