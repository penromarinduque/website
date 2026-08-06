<div class="modal fade" id="modEditPanel{{ $value->side_id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-update-side-panel', 'id' => Crypt::encrypt($value->side_id)]) }}"> {{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i> UPDATE PANEL </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label> PANEL TYPE </label>
						<select class="form-control" name="panel_type">
							<option value="1" @if($value->side_panel_flag == '1') selected @endif> With Panel </option>
							<option value="0" @if($value->side_panel_flag == '0') selected @endif> Without Panel </option>
						</select>
					</div>
					<div class="form-group">
						<label> PANEL TITLE </label>
						<input type="text" class="form-control" name="panel_title" value="{{ $value->side_panel_title }}" required>
					</div>
					<div class="form-group">
						<label> PANEL SIDE </label>
						<select class="form-control" name="panel_side">
							<option value="L" @if($value->side_panel_type == 'L') selected @endif> LEFT SIDE </option>
							<option value="R" @if($value->side_panel_type == 'R') selected @endif> RIGHT SIDE </option>
						</select>
					</div>
					<div class="form-group">
						<label> ORDER LEVEL </label>
						<input type="number" class="form-control" name="panel_order" value="{{ $value->order_level }}" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SUBMIT </button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE</button>
				</div>
			</form>
		</div>
	</div>
</div>