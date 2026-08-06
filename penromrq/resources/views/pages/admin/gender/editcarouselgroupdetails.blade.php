@extends('layouts.layout')
@section('title', 'GAD | Carousel Group Details')
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
        <li class="active"> Carousel Group Details </li>
    </ol>
</section>
<section class="content">
	@include('errors.alerts')
	<div class="box box-primary">
		<div class="box-body" id="users_box" style="min-height: 75vh;">
			<div class="panel panel-default">
				<div class="panel-heading clearfix" style="background-color: white;">
					<h3 class="panel-title pull-left">
						<label><i class="fa fa-list"></i> CAROUSEL GROUP DETAILS SETUP </label>
					</h3>
				</div>
				<div class="panel-body">
					<div class="nav-tabs-custom"> 
					    <ul class="nav nav-tabs">
					        <li><a href="{{ route('gender.route',['path' => $path]) }}"><b> <i class="fa fa-list"></i> ALL CAROUSEL </b></a></li>
					        <li class="active"><a href="#editcarousel" data-toggle="tab"><b> <i class="fa fa-edit"></i> EDIT CAROUSEL </b></a></li>
					    </ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="allcarousel"> 
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center"> GROUP </th>
										<th class="text-center"> IMAGE </th>
										<th class="text-center"> BUTTON TEXT </th>
										<th class="text-center"> BUTTON LINK </th>
										<th class="text-center"> STATUS </th>
										<th class="text-center"> ACTION </th>
									</tr>
								</thead>
								<tbody>
									@include('pages.admin.gender.includes.carouselgroupdetailstable')
								</tbody>
							</table>
						</div>
						<div class="tab-pane active fade in" id="editcarousel"> 
							@include('pages.admin.gender.forms.formeditcarouselgroupdetails')
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
	  	$('[data-toggle="popover"]').popover();
	});
	function updateStatus(id,url){
	    if($('#'+id).hasClass('fa-toggle-on')){
	        $('#'+id).removeClass('fa-toggle-on')
	        .removeClass('text-orange')
	        .addClass('fa-toggle-off').addClass('text-red');
	        tooglestatus(url,0);
	    } else if($('#'+id).hasClass('fa-toggle-off')){
	        $('#'+id).removeClass('fa-toggle-off')
	        .removeClass('text-red')
	        .addClass('fa-toggle-on').addClass('text-orange');
	        tooglestatus(url,1);
	    }
	}
	function tooglestatus(url,stat)
	{
	    $.get(url,{status:stat},function(count){ });
	}
</script>
@endpush
@endsection