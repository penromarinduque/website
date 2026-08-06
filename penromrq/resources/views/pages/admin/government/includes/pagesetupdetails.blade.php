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
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-dashboard', 'id' => Crypt::encrypt($panel->panel_id) ]) }}?dashboard"> Dashboard </a>
							</li>

							<li class="@if(request()->exists('panels')) active @endif">
								<a href="#panels" data-toggle="tab" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?panels') "> Panel </a>
							</li>

							<li class="@if(request()->exists('inputtext')) active @endif">
								<a href="#inputtext" data-toggle="tab" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?inputtext')"> Links & Texts </a>
							</li>

							<li class="@if(request()->exists('longtext')) active @endif">
								<a href="#longtext" data-toggle="tab" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?longtext')"> Posts & Messages </a>
							</li>
							
							<li class="@if(request()->exists('frameset')) active @endif">
								<a href="#frameset" data-toggle="tab" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?frameset')"> Videos & Framesets </a>
							</li>

							<li class="@if(request()->exists('storage')) active @endif">
								<a href="#storage" data-toggle="tab" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?storage') "> Images & Documents </a>
							</li>
							
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

								<div id="panels" class="tab-pane fade @if(request()->exists('panels')) in active @endif">
									@include('pages.admin.government.forms.formeditpanel',['panel' => $panel, 'path' => $path])
								</div>

								<div id="storage" class="tab-pane fade @if(request()->exists('storage')) in active @endif">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-info">
												<div class="panel-body">
													<form method="get" id="formsubmit">
														<table class="table table-bordered">
															<tr style="font-size: 12px;">
																<td style="width: 20%; padding: 7px;"><b> STATUS: </b></td>
																<td class="no-padding" style="width: 30%">
																	<select class="form-control input-sm" name="fstatus">
																		<option value=""> --Select All-- </option>
																		<option value="1" @if(request()->fstatus == '1') selected @endif> Active </option>
																		<option value="0" @if(request()->fstatus == '0') selected @endif> Inactive </option>
																	</select>
																</td>
																<td class="text-center" style="width: 20%; padding: 7px;"><b> TYPE: </b></td>
																<td class="no-padding" style="width: 30%">
																	<select class="form-control input-sm" name="ftype">
																		<option value=""> --Select All-- </option>
																		<option value="I" @if(request()->ftype == 'I') selected @endif> Image </option>
																		<option value="D" @if(request()->ftype == 'D') selected @endif> Documents </option>
																		<option value="V" @if(request()->ftype == 'V') selected @endif> Videos </option>
																	</select>
																</td>
															</tr>
															<tr style="font-size: 12px;">
																<td style="padding: 7px;"><b> DESCRIPTION:</b></td>
																<td colspan="4" class="no-padding">
																	<input type="text" class="form-control input-sm" name="fsearch" autocomplete="off" value="{{ request()->fsearch }}">
																	<input type="hidden" name="storage" value="{{ request()->storage }}">
																</td>
															</tr>
														</table>
													</form>
													<div class="clearfix">
														{{ $storage->links('vendor.pagination.admin-table-paginate') }}
														<div class="box-tools text-right">
															<button class="btn btn-primary btn-sm" onclick="return sendRequest('{{ Crypt::encrypt($panel->panel_id) }}')"  data-toggle="modal" data-target="#modaladdfiles"><i class="fa fa-plus"></i> ADD NEW  </button>
															<button class="btn btn-success btn-sm" onclick="return document.getElementById('formsubmit').submit()"><i class="fa fa-search"></i> SEARCH </button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-body">
											<table class="table table-bordered table-hover table-striped">
												<thead>
													<tr style="font-size: 12px">
														<th style="width: 25px;"> NO. </th>
														<th> FILE TYPE </th>
														<th> FILE NAME </th>
														<th> FILE LINK </th>
														<th class="text-center" style="width: 75px;"> TABS </th>
														<th class="text-center" style="width: 75px;"> STATUS </th>
														<th class="text-center" style="width: 75px;"> ACTION </th>
													</tr>
												</thead>
												<tbody>
													<?php $storageNo = 1; ?>
													@foreach($storage as $key => $value)
														<tr style="font-size: 12.5px">
															<td class="text-center" style="vertical-align: middle;">{{ $storageNo++ }}</td>
															<td style="vertical-align: middle;">
																@if($value->storage->file_type == 'I') IMAGE @endif
																@if($value->storage->file_type == 'D') DOCUMENT @endif
																@if($value->storage->file_type == 'V') VIDEO @endif
															</td>
															<td style="vertical-align: middle;"><a href="#" onclick="window.open('{{ asset($value->storage->file_path) }}'); return false;">{{ $value->storage->file_name }}</a></td>
															<td>{{ $value->storage->file_link }}</td>
															<td class="text-center">
																<i class="{{ ($value->storage->file_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggletabstorage{{ $value->storage->storage_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-storage-tab', 'id'
																 => Crypt::encrypt($value->storage->storage_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
															</td>
															<td class="text-center">
																<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatusstorage{{ $value->storage->storage_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-panel-details-status', 'id'
																 => Crypt::encrypt($value->panel_dtl_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
															</td>
															<td class="text-center">
																<a href="#editpaneldetail{{ $value->panel_dtl_id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

																<a href="{{ route('website.route',['path' => $path ,'action' => 'admin-delete-page-setup-details','id' => Crypt::encrypt($value->panel_dtl_id)]) }}" onclick="return confirm('Are you sure you want to permanently delete this row?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div id="frameset" class="tab-pane fade @if(request()->exists('frameset')) in active @endif">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-info">
												<div class="panel-body">
													<form method="get" id="formfilterframe" action="">
														<table class="table table-bordered">
															<tr style="font-size: 12px;">
																<td style="width: 20%; padding: 7px;"><b>STATUS:</b></td>
																<td class="no-padding" style="width: 80%">
																	<select class="form-control input-sm" name="frstatus">
																		<option value=""> --Select All-- </option>
																		<option value="1" @if(request()->frstatus == '1') selected @endif> Active </option>
																		<option value="0" @if(request()->frstatus == '0') selected @endif> Inactive </option>
																	</select>
																</td>
															</tr>
															<tr style="font-size: 12px;">
																<td style="width:20%; padding: 7px;"><b>DESCRIPTION:</b></td>
																<td colspan="4" class="no-padding" style="width: 80%">
																	<input type="text" class="form-control input-sm" name="frsearch" autocomplete="off" value="{{ request()->frsearch }}">
																	<input type="hidden" name="frameset" value="{{ request()->frameset }}">
																</td>
															</tr>
														</table>
													</form>
													<div class="clearfix">
														{{ $frameset->links('vendor.pagination.admin-table-paginate') }}
														<div class="box-tools pull-right">
															<button class="btn btn-primary btn-sm" onclick="return sendRequest('{{ Crypt::encrypt($panel->panel_id) }}')"  data-toggle="modal" data-target="#modaladdframes"><i class="fa fa-plus"></i> ADD NEW  </button>

															<button class="btn btn-success btn-sm" onclick="return document.getElementById('formfilterframe').submit()"><i class="fa fa-search"></i> SEARCH </button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="panel panel-info">
												<div class="panel-body">
													<table class="table table-bordered table-hover table-striped">
														<thead>
															<tr style="font-size: 12px">
																<th style="width: 25px;"> NO. </th>
																<th style="width: 25%;"> FRAME NAME </th>
																<th style="width: 25%;"> FRAME THUMBNAIL </th>
																<th style="width: 25%;"> FRAME PATH </th>
																<th class="text-center" style="min-width: 70px;"> TABS </th>
																<th class="text-center" style="min-width: 70px;"> STATUS </th>
																<th class="text-center" style="min-width: 70px;"> ACTION </th>
															</tr>
														</thead>
														<tbody>
															<?php $frameNo = 1; ?>
															@foreach($frameset as $key => $value)
																<tr style="font-size: 12px">
																	<td class="text-center">{{ $frameNo++ }}</td>
																	<td>{{ $value->frameset->frame_name }}</td>
																	<td><a href="#" onclick="window.open('{{ asset($value->frameset->frame_thumbnail) }}'); 
																				              return false;" data-toggle="tooltip" title="THUMBNAIL"> {{ $value->frameset->frame_name }} </a></td>
																	<td style="white-space: nowrap; max-width: 25px; text-overflow: ellipsis; overflow: hidden;">
																		<a href="#modalviewframeset{{ $value->frameset->frame_id }}" data-toggle="modal" title="VISIT FRAMESET">{{ substr($value->frameset->frame_path, 0,100) }}...</a>
																	</td>
																	<td class="text-center">
																		<i class="{{ ($value->frameset->frame_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggleframesettab{{ $value->frameset->frame_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-frameset-tab', 'id'
																	 => Crypt::encrypt($value->frameset->frame_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
																	</td>
																	<td class="text-center">
																		<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggleframesetstatus{{ $value->frameset->frame_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-panel-details-status', 'id'
																		 => Crypt::encrypt($value->panel_dtl_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
																	</td>
																	<td class="text-center">
																		<a href="#editpaneldetail{{ $value->panel_dtl_id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

																		<a href="{{ route('website.route',['path' => $path ,'action' => 'admin-delete-page-setup-details','id' => Crypt::encrypt($value->panel_dtl_id)]) }}" onclick="return confirm('Are you sure you want to permanently delete this row?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div id="longtext" class="tab-pane fade @if(request()->exists('longtext')) in active @endif">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-info">
												<div class="panel-body">
													<form method="get" id="formfilterlongtext" action="">
														<table class="table table-bordered">
															<tr style="font-size: 12px;">
																<td style="width: 20%; padding: 7px;"><b> STATUS: </b></td>
																<td class="no-padding" style="width: 80%">
																	<select class="form-control input-sm" name="fltstatus">
																		<option value=""> --Select All-- </option>
																		<option value="1" @if(request()->fltstatus == '1') selected @endif> Active </option>
																		<option value="0" @if(request()->fltstatus == '0') selected @endif> Inactive </option>
																	</select>
																</td>
															</tr>
															<tr style="font-size: 12px;">
																<td style="padding: 7px;"><b> DESCRIPTION: </b></td>
																<td colspan="4" class="no-padding" style="width: 80%">
																	<input type="text" class="form-control input-sm" name="fltsearch" autocomplete="off" value="{{ request()->fltsearch }}" placeholder="Search here...">
																	<input type="hidden" name="longtext" value="{{ request()->longtext }}">
																</td>
															</tr>
														</table>
													</form>
													<div class="box-tools text-right">
														{{ $longtext->links('vendor.pagination.admin-table-paginate') }}
														<button class="btn btn-primary btn-sm" onclick="return sendRequest('{{ Crypt::encrypt($panel->panel_id) }}')"  data-toggle="modal" data-target="#modaladdlongtext"><i class="fa fa-plus"></i> ADD NEW  </button>

														<button class="btn btn-success btn-sm" onclick="return document.getElementById('formfilterlongtext').submit()"><i class="fa fa-search"></i> SEARCH </button>
													</div>
												</div>
											</div>
										</div>	
										<div class="col-md-12">
											<div class="panel panel-info">
												<div class="panel-body">
													<table class="table table-bordered table-hover table-striped">
														<thead>
															<tr style="font-size: 12px">
																<th style="width: 25px;"> NO. </th>
																<th style="width: 50%;"> DESCRIPTION  </th>
																<th style="width: 50%;"> PARAGRAPH </th>
																<th class="text-center" style="min-width: 75px;"> STATUS </th>
																<th class="text-center" style="min-width: 75px;"> ACTION </th>
															</tr>
														</thead>
														<tbody>
															<?php $postNo = 1; ?>
															@foreach($longtext as $key => $value)
																<tr style="font-size: 12px">
																	<td class="text-center">{{ $postNo++ }}</td>
																	<td style="white-space: nowrap; max-width: 25px; text-overflow: ellipsis; overflow: hidden; vertical-align: middle;">
																		{{ substr($value->longtext->long_description, 0,100) }}
																	</td>
																	<td style="white-space: nowrap; max-width: 25px; text-overflow: ellipsis; overflow: hidden; vertical-align: middle;">
																		{{ substr($value->longtext->long_text, 0,100) }}
																	</td>
																	<td class="text-center">
																		<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglelongtextstatus{{ $value->longtext->text_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-panel-details-status', 'id'
																		 => Crypt::encrypt($value->panel_dtl_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
																	</td>
																	<td class="text-center">
																		<a href="#editpaneldetail{{ $value->panel_dtl_id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

																		<a href="{{ route('website.route',['path' => $path ,'action' => 'admin-delete-page-setup-details','id' => Crypt::encrypt($value->panel_dtl_id)]) }}" onclick="return confirm('Are you sure you want to permanently delete this row?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div id="inputtext" class="tab-pane fade @if(request()->exists('inputtext')) in active @endif">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-body">
													<form method="get" id="formfilterinputtext" action="">
														<table class="table table-bordered">
															<tr style="font-size: 12px;">
																<td style="width: 20%; padding: 7px;"><b> STATUS: </b></td>
																<td class="no-padding" style="width: 80%">
																	<select class="form-control input-sm" name="fitstatus">
																		<option value=""> --Select All-- </option>
																		<option value="1" @if(request()->fitstatus == '1') selected @endif> Active </option>
																		<option value="0" @if(request()->fitstatus == '0') selected @endif> Inactive </option>
																	</select>
																</td>
															</tr>
															<tr style="font-size: 12px;">
																<td style="padding: 7px;"><b> DESCRIPTION:</b></td>
																<td colspan="4" class="no-padding" style="width: 80%">
																	<input type="text" class="form-control input-sm" name="fitsearch" autocomplete="off" value="{{ request()->fitsearch }}" placeholder="Search here...">
																	<input type="hidden" name="inputtext" value="{{ request()->inputtext }}">
																</td>
															</tr>
														</table>
													</form>

													<div class="clearfix">
														{{ $inputtext->links('vendor.pagination.admin-table-paginate') }}
														<div class="box-tools pull-right">
															<button class="btn btn-primary btn-sm" onclick="return sendRequest('{{ Crypt::encrypt($panel->panel_id) }}')"  data-toggle="modal" data-target="#modaladdnewtext"><i class="fa fa-plus"></i> ADD NEW  </button>

															<button class="btn btn-success btn-sm" onclick="return document.getElementById('formfilterinputtext').submit()"><i class="fa fa-search"></i> SEARCH </button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="panel panel-info">
												<div class="panel-body">
													<table class="table table-bordered table-hover table-striped">
														<thead>
															<tr style="font-size: 12px">
																<th style="width: 25px;"> NO. </th>
																<th style="width: 50%;"> TEXT  </th>
																<th style="width: 50%;"> TEXT LINK </th>
																<th class="text-center" style="min-width: 70px;"> TABS </th>
																<th class="text-center" style="min-width: 70px;"> STATUS </th>
																<th class="text-center" style="min-width: 70px;"> ACTION </th>
															</tr>
														</thead>
														<tbody>
															<?php $textNo = 1; ?>
															@foreach($inputtext as $key => $value)
																<tr style="font-size: 12.5px">
																	<td class="text-center" style="vertical-align: middle;">{{ $textNo++ }} </td>
																	<td style="white-space: nowrap; max-width: 25px; text-overflow: ellipsis; overflow: hidden; vertical-align: middle;"> 
																		{{ substr($value->inputtext->text_description, 0,100) }} 
																	</td>
																	<td style="white-space: nowrap; max-width: 25px; text-overflow: ellipsis; overflow: hidden; vertical-align: middle;">
																		{{ substr($value->inputtext->text_link, 0,100) }} 
																	</td>
																	<td class="text-center">
																		<i class="{{ ($value->inputtext->text_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggleinputtexttab{{ $value->inputtext->text_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-input-text-tab', 'id'
																		 => Crypt::encrypt($value->inputtext->text_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
																	</td>
																	<td class="text-center">
																		<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggleinputtextstatus{{ $value->inputtext->text_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-panel-details-status', 'id'
																		 => Crypt::encrypt($value->panel_dtl_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
																	</td>
																	<td class="text-center">

																		<a href="#editpaneldetail{{ $value->panel_dtl_id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

																		<a href="{{ route('website.route',['path' => $path ,'action' => 'admin-delete-page-setup-details','id' => Crypt::encrypt($value->panel_dtl_id)]) }}" onclick="return confirm('Are you sure you want to permanently delete this row?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
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
		            		@include('pages.admin.government.forms.formeditstorage',['value' => $value])
		            	@endif
		            	@if($value->panel_dtl_type == 2)
		            		@include('pages.admin.government.forms.formeditframeset',['value' => $value])
		            	@endif
		            	@if($value->panel_dtl_type == 3)
			            	@include('pages.admin.government.forms.formeditlongtext',['value' => $value])
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

	@foreach($frameset as $key => $frame)
		@include('pages.admin.government.modal.modalviewframeset',['frame' => $frame->frameset,'frame_path' => $frame->frameset->frame_path])
	@endforeach

	@include('pages.admin.government.modal.modaladdtext')
	@include('pages.admin.government.modal.modaladdfiles')
	@include('pages.admin.government.modal.modaladdframes')
	@include('pages.admin.government.modal.modaladdlongtext')
	
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