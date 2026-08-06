@extends('layouts.layout')
@section('title', 'Side Panel Setup')
@section('content')
<section class="content-header">
	<h1> &nbsp; </h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Side Panel Setup </li>
	</ol>
</section>
<div class="content">
	@include('errors.alerts')
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-bars fa-fw"></i> SIDE PANEL SETUP <small> Control panel </small></h3>
			<div class="box-tools pull-right">
				<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaladdsidepanel"><i class="fa fa-plus"></i> CREATE </button>
				@include('pages.admin.government.modal.modaladdsidepanel')
			</div>
		</div>
		<div class="box-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<style type="text/css">
							iframe
							{
								width: 100%;
								border: none;
							}
						</style>
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><b>LEFT SIDE</b></h3>
								</div>
								<div class="panel-body">
									@include('pages.admin.government.includes.sidepaneldetails', ['side_data' => $left_panel])
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><b>RIGHT SIDE</b></h3>
								</div>
								<div class="panel-body">
									@include('pages.admin.government.includes.sidepaneldetails', ['side_data' => $right_panel])
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
	function passValuetoInput(value,id)
	{
		$('#image_link' + id).val(value);
		return false;
	}
	function toggleSubrow(id)
	{
		$('#subRow' + id).toggle('show');
		$('#toggleButton' + id).toggleClass('fa-minus fa-plus');
	}
	function updateRow(id)
	{
		$('#f_hd_id').val(function(){
			return id;
		});
		$('#f_hd_type').val(function(){
			return $('#i_hd_type' + id).val();
		});
		$('#f_hd_title').val(function(){
			return $('#i_hd_title' + id).val();
		});
		$('#f_hd_order').val(function(){
			return $('#i_hd_orderlevel' + id).val();
		});
		if(confirm('Are you sure you want to update this row?')){
			$('#updateHeaderForm').submit();
		}
	}
	function updateSideDetail(evt,id)
	{
		if(evt == 'I')
		{
			$('.detail-image-' + id).css('display','inline');
			$('.detail-frame-' + id).css('display','none');
		}else if(evt == 'F')
		{
			$('.detail-image-' + id).css('display','none');
			$('.detail-frame-' + id).css('display','inline');
		}
	}
	function addSideDetail(evt,id)
	{
		if(evt == 'I')
		{
			$('.add-dtl-img-' + id).css('display','inline');
			$('.add-dtl-frame-' + id).css('display','none');
		}else if(evt == 'F')
		{
			$('.add-dtl-img-' + id).css('display','none');
			$('.add-dtl-frame-' + id).css('display','inline');
		}
	}
	function deletePanel(evt)
	{
		var url = '<?php echo route("website.route",["path" => $path, "action" => "admin-delete-side-panel","id" => Crypt::encrypt('')]) ?>';
		if(confirm('Are you sure you want to delete?')) {
			$.post(url, {_token:$('meta[name="csrf-token"]').attr('content'),id:evt.id},
			function(data){ console.log(data); $('#div_panel_' + data).fadeOut(1000); });
		}
	}
function deleteDetail(evt)
{

	var url = '{{ route("website.route",["path" => $path, "action" => "admin-delete-side-panel-detail","id" => Crypt::encrypt('')]) }}';

	if(confirm('Are you sure you want to delete?')){

		$.post(url, {	

			_token:$('meta[name="csrf-token"]').attr('content'),id:evt.id},

			function(data){ 
				$('#div_detail_' + data).fadeOut(1000); 
			});

		}

	}

	function deleteRow(id,table)
	{

		$('#leftsidebarId').val(id);
		$('#leftsidebarTable').val(table);

	if(confirm('Are you sure you want to delete this row?'))
	{
		$('#deleteRowForm').submit();
	}

}
</script>
@endsection