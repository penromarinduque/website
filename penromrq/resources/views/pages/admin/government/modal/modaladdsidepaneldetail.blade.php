<div class="modal fade" id="mod_add_detail_{{ $side_id }}" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-side-panel-detail','id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
				<div class="modal-header text-left">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> ADD PANEL DETAIL </h4>
				</div>
				<div class="modal-body text-left">
					<div class="form-group">
						<label> DETAIL TYPE </label>
						<select name="type" class="form-control" onchange="return addSideDetail(this.value,{{ $side_id }})" style="border-color: red;">
							<option value="I" selected>Image</option>x
							<option value="F">Frame</option>
						</select>
						<input type="hidden" name="side_id" value="{{ Crypt::encrypt($side_id) }}">
					</div>
					<div class="form-group">
						<label> DETAIL DESCRIPTION </label>
						<input type="text" class="form-control" name="text" autocomplete="off">
					</div>
					<div class="form-group add-dtl-img-{{ $side_id }}">
						<label> IMAGE LINK </label>
						<input type="text" class="form-control" name="link">
					</div>
					<div class="form-group add-dtl-img-{{ $side_id }}">
						<label> UPLOAD IMAGE </label>
						<input type="file" class="form-control" name="image">
					</div>
					<div class="form-group add-dtl-frame-{{ $side_id }}" style="display: none;">
						<label> EMBEDED SOURCE </label>
						<textarea class="form-control" name="frameset" style="resize: vertical; min-height: 150px;"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT </button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
				</div>
			</form>
		</div>
	</div>
</div>