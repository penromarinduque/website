@extends('pages.website.government.includes.layout')

@section('content')

@include('pages.website.government.includes.topnav')

@include('pages.website.government.includes.masterhead')

<div class="container-fluid" style="background-color: #f2f2f2">
	<div class="container">
		<div class="row" style="padding-top: 15px;">
			<div class="col-md-8">
				<div class="panel panel-success">
				  	<div class="panel-heading bg-green">
				   		<h3 class="panel-title text-white"><b> Search Results </b></h3>
				  	</div>
				  	<div class="panel-body">
				  		<div class="form-group text-center" style="background-color: #FFFFFF;padding: 20px;">
				  			<label> No result's found </label>
				  		</div>
				  	</div> 
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-success">
				  	<div class="panel-heading bg-green">
				   		<h3 class="panel-title text-white"><b> Related Searches </b></h3>
				  	</div>
				  	<div class="panel-body">
				  		<div class="form-group text-center" style="background-color: #FFFFFF;padding: 20px;">
				  			<label> No result's found </label>
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