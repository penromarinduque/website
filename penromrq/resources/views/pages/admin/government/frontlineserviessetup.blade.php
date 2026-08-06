@extends('layouts.layout')

@section('title', 'Frontline Services Setup')

@section('content')

<section class="content-header">
	<h1> &nbsp; </h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Frontline Services Setup </li>
	</ol>
</section>

<div class="content">
	@include('errors.alerts')
	<div class="box box-primary">
		<div class="box-header with-border">
    		<h3 class="box-title">
				<i class="fa fa-bars fa-fw"></i> FRONTLINE SERVICES SETUP
				<small> Control panel </small>
			</h3>
	    	<div class="box-tools pull-right">
    	    	<button class="btn btn-warning btn-sm" id="btnaddfrontline" @if(count($frontline) >= 5) disabled @else data-toggle="modal" data-target="#modaladdfrontline" @endif><i class="fa fa-plus fa-fw"></i> Front Line Services <span id="frontcount">{{ count($frontline) }}</span> / 5 </button>
    	    </div>
	    </div>
	    <div class="box-body" style="min-height: 75vh;">
	    	<div class="row">
		    	<div class="col-md-12">
			    	<div class="panel panel-default">
			    		<div class="panel-body">
			    			@foreach($frontline as $key => $value)
			    				<div class="row">
			    					<div class="col-sm-12">
				    					<div class="panel panel-default">
				    						<div class="panel-body">
						    					<div class="col-sm-3">
						    						<img class="img-thumbnail" src="{{ asset($value->front_image_path) }}">
						    					</div>
						    					<div class="col-sm-9">
			    						    		<table class="table table-bordered" style="font-size: 9pt;">
			    										<tr>
			    											<th> IMAGE LINK </th>
			    											<td>{{ $value->front_link }} </td>
			    										</tr>
			    										<tr>
			    											<th> DESCRIPTION </th>
			    											<td>{{ $value->front_text }} </td>
			    										</tr>
			    										<tr>
			    											<th style="width: 50px;"> ORDER </th>
			    											<td>{{ $value->order_level }} </td>
			    										</tr>
			    										<tr>
			    											<th style="width: 100px;"> STATUS </th>
			    											<td>
			    												<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->front_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-frontline','id' => encrypt($value->front_id)]) }}')" style="font-size: 23px; cursor: pointer;"></i>
			    											</td>
			    										</tr>
			    										<tr>
			    											<th style="width: 100px;"> ACTION </th>
			    											<td>
			    												<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modaleditfrontline{{ $value->front_id }}"><i class="fa fa-edit"></i></button>
			    												<button class="btn btn-danger btn-xs" id="btndeletefronline{{$value->front_id}}" onclick="return deleteFrontline('{{ route('website.route',['path' => $path,'action' => 'admin-delete-frontline','id' => encrypt($value->front_id)]) }}')"><i class="fa fa-trash"></i></button>
			    												@include('pages.admin.government.modal.modaleditfrontline')
			    											</td>
			    										</tr>  		
			    							    	</table>
						    					</div>
						    				</div>
						    			</div>
						    		</div>
			    				</div>
					    	@endforeach
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('pages.admin.government.modal.modaladdfrontline')
@push('scripts')
<script type="text/javascript">
	function updateStatus(id,url) {
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			tooglestatus(url,0)
		} else if($('#'+id).hasClass('fa-toggle-off')) {
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			tooglestatus(url,1)
		}
	}
	function tooglestatus(url,stat)
	{
	    $.get(url,{status:stat},function(count){ 
	    	$('#frontcount').html(count)
	    	if(count >= 5) {
	    		$('#btnaddfrontline').prop('disabled',true);
	    	} else {
	    		$('#btnaddfrontline').prop('disabled',false);
	    		// window.location.reload();
	    	}
	    });
	}
	function deleteFrontline(url) {	
		if(confirm('Are you sure you want to delete this row?')) {
			$.get(url,function(data){ window.location.reload(); });
		}
	}
</script>
@endpush
@endsection

