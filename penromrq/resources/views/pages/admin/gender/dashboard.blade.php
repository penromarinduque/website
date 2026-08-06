@extends('layouts.layout')
@section('title', 'GAD | Dashboard')
@section('content')
<section class="content-header">
    <h1> &nbsp; </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
    </ol>
</section>
<section class="content">
	@include('errors.alerts')
</section>
@endsection