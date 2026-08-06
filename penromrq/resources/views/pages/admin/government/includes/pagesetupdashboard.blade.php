@extends('layouts.layout')

@section('title', 'Page Details')

@section('content')

<style type="text/css">
    .storage-grid-image 
    {
        cursor: pointer;
        height: 150px;
        margin-bottom: 10px;
        transition: 0.3s;
        overflow: hidden;
    }
    .storage-grid-image:hover
    {
        border: 1px solid #999;
        box-shadow: 1px 1px 5px 3px #999;
        transition: 0.3s;
    }
    .selected
    {
        border: 1px solid #999;
        box-shadow: 1px 1px 5px 3px #999;
    }
    .storage-grid-image .hidden-checkbox
    {
        position: absolute;
        opacity: 0;
    }
    .longtext-list-view
    {
    	padding: 10px;
    	margin-bottom: 10px;
    	font-size: 12px;
    }
    .longtext-list-view:hover
    {
    	border: 1px solid #999;
        box-shadow: 1px 1px 5px 3px #999;
        transition: 0.3s;
    }
    .longtext-list-view .hidden-checkbox
    {
    	position: absolute;
        opacity: 0;
    }
</style>

<section class="content-header">
	<h1>
		<i class="fa fa-box"></i> Page Details
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Page Details </li>
	</ol>
</section>

<div class="content">

	@include('errors.alerts')

	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-list"></i> TABS </h3>
				</div>
				<div class="box-body" style="height: 75.5vh;">
					<div class="nav-tabs-custom" style="text-transform: uppercase; font-size: 12px;">
						<ul class="nav nav-default nav-stacked">
				
							<li class="@if(request()->exists('dashboard')) active @endif">
								<a href="#dashboard" data-toggle="tab" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?dashboard') "> Dashboard </a></li>

							<li class="@if(request()->exists('panels')) active @endif">
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-details', 'id' => Crypt::encrypt($panel->panel_id) ]) }}?panels"> Panel </a></li>

							<li class="@if(request()->exists('inputtext')) active @endif">
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-details', 'id' => Crypt::encrypt($panel->panel_id) ]) }}?inputtext"> Links & Texts </a></li>

							<li class="@if(request()->exists('longtext')) active @endif">
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-details', 'id' => Crypt::encrypt($panel->panel_id) ]) }}?longtext"> Posts & Messages </a></li>
							
							<li class="@if(request()->exists('frameset')) active @endif">
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-details', 'id' => Crypt::encrypt($panel->panel_id) ]) }}?frameset"> Videos & Framesets </a></li>

							<li class="@if(request()->exists('storage')) active @endif">
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-details', 'id' => Crypt::encrypt($panel->panel_id) ]) }}?storage"> Images & Documents </a></li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-9">

			<div class="box box-primary">

				<div class="box-header" style="text-transform: uppercase;">
					<h3 class="box-title"><i class="fa fa-table"></i> CONTENT / DETAILS
				</div> 

				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="tab-content" style="min-height: 72.9vh;">
								<div id="dashboard" class="tab-pane fade @if(request()->exists('dashboard')) in active @endif">
									<div class="box box-default box-solid">
										<div class="box-header with-border">
											<h3 class="box-title"><b>{{ $panel->panel_name }}</b></h3>
										</div>
									</div>
									@foreach($dashboard as $key => $value)
										<div class="box box-default box-solid">
											<div class="box-header with-border">
												<h3 class="box-title" style="text-transform: uppercase;"><b>{{ $value->detail_type->type_description }}</b></h3>
												<div class="box-tools pull-right">
									               	<button type="button" class="btn btn-box-tool"><b>{{ $value->order_level }}</b></button>
									            </div>
											</div>
											<div class="panel-body"> 
												@if($value->panel_dtl_type == 1)
													@if($value->storage->file_type == 'I')
														<div class="form-group text-center">
															<label>{{ $value->storage->file_name  }}</label>
															<a href="{{ $value->storage->file_link }}" @if($value->storage->file_tab == 1) target="_blank" @endif> 
																<img src="{{ asset($value->storage->file_path) }}" style="width: 100%;">
															</a>
														</div>
													@endif
													@if($value->storage->file_type == 'D') 
														<div class="form-group text-center">
															<label>{{ $value->storage->file_name  }}</label>
															<a href="{{ $value->storage->file_link }}" @if($value->storage->file_tab == 1) target="_blank" @endif> 
																{{ $value->storage->file_path }}
															</a>
														</div>
													@endif
													@if($value->storage->file_type == 'V') 
														<div class="form-group text-center">
															<label>{{ $value->storage->file_name  }}</label>
															<a href="{{ $value->storage->file_link }}" @if($value->storage->file_tab == 1) target="_blank" @endif> 
																{{ $value->storage->file_path }}
															</a>
														</div>
													@endif
												@endif
												@if($value->panel_dtl_type == 2)
													{!! $value->frameset->frame_path !!}
												@endif
												@if($value->panel_dtl_type == 3)
													<p style="font-weight: bold;text-align: center;">
														{{ $value->longtext->long_description }}
													</p>
													<div style="text-align: justify;">
														{!! $value->longtext->long_text !!}
													</div>
												@endif
												@if($value->panel_dtl_type == 4)
													<a href="{{ $value->inputtext->text_link }}" @if($value->inputtext->text_tab == 1) @endif> 
														{{ $value->inputtext->text_description }}
													</a>
												@endif
											</div>
											<div class="panel-footer clearfix">
												<div class="box-tools pull-right">

													<a href="#editpaneldetail{{ $value->panel_dtl_id }}" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

													<a href="{{ route('website.route',['path' => $path ,'action' => 'admin-delete-page-setup-details','id' => Crypt::encrypt($value->panel_dtl_id)]) }}" onclick="return confirm('Are you sure you want to permanently delete this row?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

												</div>
											</div>
										</div>
									@endforeach
									<div class="panel panel-info">
										<div class="panel-footer no-padding clearfix">
											<div class="box-tools pull-right">
												{{ $dashboard->links('vendor.pagination.admin-table-paginate') }}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	@foreach($dashboard as $key => $value)
		<div class="modal fade" id="editpaneldetail{{ $value->panel_dtl_id }}">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title"> <i class="fa fa-edit"></i> UPDATE DETAILS </h4>
		            </div>
		            <div class="modal-body">
		            	@if($value->panel_dtl_type == 1)
		            		@include('pages.admin.government.forms.formeditstorage',  ['value' => $value])
		            	@endif
		            	@if($value->panel_dtl_type == 2)
		            		@include('pages.admin.government.forms.formeditframeset', ['value' => $value])
		            	@endif
		            	@if($value->panel_dtl_type == 3)
			            	@include('pages.admin.government.forms.formeditlongtext', ['value' => $value])
		            	@endif
		            	@if($value->panel_dtl_type == 4)
		            		@include('pages.admin.government.forms.formeditinputtext',['value' => $value])
		            	@endif
		            </div>
		            <div class="modal-footer">
		            	<button type="button" onclick="return document.getElementById('updateformdetail{{ $value->panel_dtl_id }}').submit()" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> UPDATE </button>
		                <button type="button" class="btn btn-danger btn-sm stopwatchingyoutube" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
		            </div>
		        </div>
		    </div>
		</div>
	@endforeach
</div>{{-- ./ row --}}

@endsection
@section('scripts')
<script type="text/javascript">

	$(document).ready(function(){
		$('.stopwatchingyoutube').click(function(){
		    $('.myyoutubeclass').each(function(){
		        $(this).stopVideo();
		    });
		});
	});

	function updateStatus(id,url)
	{
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

	function submitForms(evt)
	{
	    if(evt == 'btn_add')
	    {
	        $('.btn_add').show();
	        $('.btn_select').hide();
	    }
	    if(evt == 'btn_select')
	    {
	        $('.btn_add').hide();
	        $('.btn_select').show();
	    }
	}

	function toogleCheck(evt) {
	    var checkBox = document.getElementById('checkbox' + evt);
	    $('#toggle_class' + evt).toggleClass('selected');
	}

	function sendRequest(id){
		$('.set_id').val(id);
		submitForms('btn_add');
	}

</script>
@endsection