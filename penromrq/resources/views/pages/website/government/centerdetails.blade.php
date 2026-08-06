@extends('pages.website.government.includes.layout')

@section('content')

@include('pages.website.government.includes.topnav')

@include('pages.website.government.includes.masterhead')

<div class="container-fluid bg-gray">
	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="/"> Home </a></li>
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="" onclick="return false;"> News & Events </a></li>
						<li class="breadcrumb-item active"> Press Releases </li>
					</ol>
				</nav>
			</div>
			<div class="col-lg-12" style="position: relative;">
				<div class="panel panel-success">
					<div class="panel-heading bg-green">
						<h3 class="panel-title" style="color: white;"><b> {{ $details->created_by }} </b></h3>
					</div>
					<div class="panel-body" style="min-height: 500px;">
						<div class="row"> 
							<div class="col-lg-12">
								<img src="{{ asset($details->created_image) }}" class="img-thumbnail" style="width:100%; height: 55vh;" alt="{{ $details->created_title }}">
							</div>
							<div class="col-lg-12"> 
								{!! $details->created_story !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection