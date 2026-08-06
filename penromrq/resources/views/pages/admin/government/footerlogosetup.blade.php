@extends('layouts.layout')

@section('title', 'Agency Footer Setup')

@section('content')

<section class="content-header">
	<h1>
		<i class="fa fa-box"></i> Agency Footer Setup
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Footer Panel </li>
	</ol>
</section>

<div class="content">
</div>

@endsection