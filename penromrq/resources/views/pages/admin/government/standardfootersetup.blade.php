@extends('layouts.layout')

@section('title', 'Standard Footer Setup')

@section('content')

<section class="content-header">
	<h1>
		<i class="fa fa-box"></i> Standard Footer Setup
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Footer Panel </li>
	</ol>
</section>

<div class="content">
	@include('errors.alerts')
	<div class="box box-primary">
	    <div class="box-header with-border">
	        <h3 class="box-title">
	            <i class="fa fa-bars"></i> AGENCY FOOTER SETUP
	            <small> Control panel </small>
	        </h3>
	    </div>
	    <div class="box-body">
	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body" style="height: 70vh;">
		    			<div class="row">
		    				<div class="col-md-12" style="margin-bottom: 10px;">
		    					<div class="box-tools pull-right">
			    					<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaladdfooter">
			    						<i class="fa fa-plus"></i> CREATE 
			    					</button>
			    				</div>
		    				</div>
		    				<div class="col-md-12">
		    					<div class="nav-tabs-custom" style="text-transform: uppercase; font-size: 12px;">
		    						<ul class="nav nav-default nav-stacked">
		    							@foreach($footer as $value)
		    						    <li class="@if($value->order_level == 1) active @endif"><a href="#tab{{ $value->footer_id }}" data-toggle="tab">
		    						        <i class="fa fa-folder-o fa-fw"></i> {{ $value->footer_title }} </a>
		    						    </li>
		    						    @endforeach
		    						</ul>
		    					</div>
		    				</div>
		    			</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-9">
	    		<div class="panel panel-default">
	    			<div class="panel-body" style="height: 70vh;">
	    				<div class="tab-content">

	    					@foreach($footer as $value)

	    					@include('pages.admin.government.modal.modaladdfooterdetails' ,['footerid' => $value->footer_id])

	    					@include('pages.admin.government.modal.modaleditfooterdetails',['footerid' => $value->footer_id])

	    					<div class="tab-pane @if($value->order_level == 1) active @endif" id="tab{{ $value->footer_id }}">
	    						<div class="row">
	    							<div class="col-md-12" style="margin-bottom: 10px;">
	    								<div class="box-tools pull-right">
	    									<button class="btn btn-primary btn-sm" onclick="return submitfooterchanges('{{ $value->footer_id }}')" disabled>
	    										<i class="fa fa-save"></i> UPDATE 
	    									</button>
	    									<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addfooterdetail{{ $value->footer_id }}">
	    										<i class="fa fa-plus"></i> CREATE 
	    									</button>
	    								</div>
	    							</div>
		    						<div class="col-md-12">
		    							@include('pages.admin.government.includes.footertabledetails')
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

@include('pages.admin.government.modal.modaladdfooter')

@push('scripts')
<script type="text/javascript">
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
	function deleteFooterDetail(url)
	{
		if(confirm('Are you sure you want to delete this row?'))
		{
			$.get(url,function(){ window.location.reload() });
		}
	}
	function submitfooterchanges(evt){
		$('#updateform' + evt).submit();
	}
	function changebgcolor(evt)
	{
		if($('#imagecheckbox' + evt).is(':checked'))
		{
			$('#imagebackcolor' + evt).removeClass('bg-gray-light').addClass('dark');
		}else{
			$('#imagebackcolor' + evt).removeClass('dark').addClass('bg-gray-light');
		}
		
	}
</script>
@endpush

@endsection

