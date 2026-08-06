@extends('layouts.layout')

@section('title', 'Center Panel')

@section('content')

<style type="text/css">
	.box-shadow{
	 	box-shadow: 1px 2px 5px 2px #999;
	}
	.border-light{
		box-shadow: 0.9px 1px 3px 3px #f7f5f5;
	}
	.font-12
	{
		font-size: 12px;
	}
	.nowrap
	{
		white-space: nowrap;
	}
</style>

<section class="content-header">
	<h1> &nbsp; </h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Center Panel Setup </li>
	</ol>
</section>

<div class="content">

	@include('errors.alerts')

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<div class="box-title">
						<label><i class="fa fa-bars fa-fw"></i> CENTER PANEL SETUP </label>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-default" style="height: 73vh;">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12" style="margin-bottom: 15px;">
											<div class="pull-right">
												<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addPanelModal">
													<i class="fa fa-plus"></i> CREATE
												</button>
												@include('pages.admin.government.modal.modaladdpanel')
											</div>
										</div>
										<div class="col-md-12">
											<div class="nav-tabs-custom">
												<ul class="nav nav-tab nav-stacked font-12" id="nav-class" style="text-transform: uppercase;">
													@foreach($center_panel_data as $key => $value)
														<li class="@if(array_key_exists( $value->center_panel_code , request()->all())) active @endif">
															<a class="a-label" href="?{{ $value->center_panel_code }}" 
																data-target="#{{ $value->center_panel_code }}" 
																data-toggle="tab"><i class="{{ $value->center_panel_icon }} fa-fw"></i> {{ $value->center_panel_title }} 
															</a>
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
							<div class="panel panel-default" style="height: 73vh;">
								<div class="panel-body">
									<div class="tab-content">
										@foreach($center_panel_data as $key => $value)
											<div class="@if(array_key_exists( $value->center_panel_code , request()->all())) active @endif tab-pane" id="{{ $value->center_panel_code }}"> 
												@include('pages.admin.government.includes.'.$value->center_panel_blade,[
													'action' => $value->center_panel_action, 'center' => $value,
												])	
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>{{-- ./ row --}}

@endsection

@section('scripts')

<script type="text/javascript">

	$(document).ready(function(){
		$('.check_flag_img_vid').on('click',function(){
			if($(this).prop("checked") == true)
			{
				$('.image-type').css('display','block');
				$('.video-type').css('display','none');
			}else{
				$('.video-type').css('display','block');
				$('.image-type').css('display','none');
			}
		});
	});

	$('#nav-class').on('click','.a-label',function(){
		history.pushState({urlPath:this.href},"",this.href)
	});
				
	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(count){  });
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(count){  });
		}
	}

</script>
@endsection