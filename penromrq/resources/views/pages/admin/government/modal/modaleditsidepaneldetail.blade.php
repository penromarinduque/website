<div class="modal fade" id="modaleditdetail{{ $detail->detail_id }}" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-update-side-panel-detail', 'id' => encrypt($detail->detail_id)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
				<div class="modal-header text-left">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i> UPDATE PANEL DETAILS </h4>
				</div>
				<div class="modal-body text-left">
					<table class="table table-bordered">
						<tr>
							<td class="text-center" style="width: 30%;">
								<div class="form-group detail-image-{{ $detail->detail_id }}" @if($detail->detail_flag != 'I') style="display:none;" @endif>
									<label> IMAGE PREVIEW </label><br>
									<img src="{{ asset($detail->detail_path) }}" class="img-thumbnail" style="max-width: 130px;">
								</div>
								<div class="form-group detail-frame-{{ $detail->detail_id }}" @if($detail->detail_flag != 'F') style="display:none;" @endif>
									<label> FRAME PREVIEW </label><br>
									{!! $detail->detail_path !!}
								</div>
							</td>
							<td style="width: 70%;">
								<div class="form-group">
									<label> IMAGE TYPE </label> <span class="help-block">Try to change this for more option.</span>
									<select name="type" class="form-control" onchange="return updateSideDetail(this.value,{{$detail->detail_id}})">
										<option value="I" @if($detail->detail_flag == 'I') selected @endif>IMAGE</option>x
										<option value="F" @if($detail->detail_flag == 'F') selected @endif>EMBEDED</option>
									</select>
									<input type="hidden" name="detail_id" value="{{ encrypt($detail->detail_id) }}">
								</div>
								<div class="form-group">
									<label> IMAGE DESCRIPTION </label>
									<input type="text" class="form-control" name="text" value="{{ $detail->detail_text }}" autocomplete="off">
								</div>
							</td>
						</tr>
					</table>
					
					<div class="form-group detail-image-{{ $detail->detail_id }}" @if($detail->detail_flag != 'I') style="display:none;" @endif>
						<label> IMAGE LINK </label>
						<div class="input-group">
							<input type="text" class="form-control" id="image_link{{ $detail->detail_id }}" name="link" value="{{ $detail->detail_link }}" autocomplete="off">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Select Link
								<span class="fa fa-caret-down"></span></button>
								<ul class="dropdown-menu">
									<li class="divider">Special</li>
									@foreach($navheader3 as $spcl)
									<li><a href="#" onclick="return passValuetoInput('{{ $spcl->nav_href }}',{{ $detail->detail_id }})">{{ $spcl->nav_href }}</a></li>
									@endforeach
									<li class="divider">Top</li>
									@foreach($navheader1 as $spcl)
									<li><a href="#" onclick="return passValuetoInput('{{ $spcl->nav_href }}',{{ $detail->detail_id }})">{{ $spcl->nav_href }}</a></li>
									@endforeach
									<li class="divider">Bottom</li>
									@foreach($navheader2 as $spcl)
									<li><a href="#" onclick="return passValuetoInput('{{ $spcl->nav_href }}',{{ $detail->detail_id }})">{{ $spcl->nav_href }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<div class="form-group detail-image-{{ $detail->detail_id }}" @if($detail->detail_flag != 'I') style="display:none;" @endif>
						<label> CHANGE IMAGE </label>
						<input type="file" class="form-control" name="image">
					</div>
					<div class="form-group detail-frame-{{ $detail->detail_id }}" @if($detail->detail_flag != 'F') style="display:none;" @endif>
						<label> EMBEDED SOURCE CODE </label>
						<textarea class="form-control" name="frameset" style="resize: vertical; min-height: 150px;">@if($detail->detail_flag == 'F'){!! $detail->detail_path !!} @endif</textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> UPDATE </button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
				</div>
			</form>
		</div>
	</div>
</div>