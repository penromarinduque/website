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
		 		    	<li class="breadcrumb-item active" aria-current="page"> Priority Program Accountability Reports </li>
		 		  	</ol>
		 		</nav>
		 	</div>

 		 	@include('pages.website.government.includes.panels',['panel' => $panel])

		</div>
	</div>
</div>

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection