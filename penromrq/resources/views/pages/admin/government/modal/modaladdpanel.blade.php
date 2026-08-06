<div class="modal fade" id="addPanelModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{ route('website.route',['path' => $path ,'action' => 'admin-add-panel-header' , 'id' => Crypt::encrypt('')]) }}"> {{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> PANEL FORM </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label> PANEL TYPE </label>
						<select class="form-control" name="panel_type">
							<option value="1"> With Panel </option>
							<option value="0"> Without Panel </option>
						</select>
					</div>
					<div class="form-group">
						<label> PANEL TITLE </label>
						<input type="text" class="form-control" name="panel_title" autocomplete="off">
						<p class="help-block"> Recommended if panel type is 'with panel'.</p>
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
