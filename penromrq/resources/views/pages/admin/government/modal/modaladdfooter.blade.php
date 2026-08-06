<div class="modal fade" id="modaladdfooter">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-footer', 'id' => encrypt('')]) }}"> {{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Footer Details </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label> Footer Column </label>
						<select class="form-control" name="footer_column">
							<option value="col-md-12"> x12 </option>
							<option value="col-md-4"> x4 </option>
							<option value="col-md-2"> x2 </option>
						</select>
					</div>
					<div class="form-group">
						<label> Footer Title </label>
						<input type="text" class="form-control" name="footer_title" required>
						<input type="hidden" class="form-control" name="footer_type" value="A">
					</div>
					<div class="form-group">
						<label> Footer Align </label>
						<select class="form-control" name="footer_align">
							<option value="L"> LEFT </option>
							<option value="C"> CENTER </option>
							<option value="R"> RIGHT </option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
				</div>
			</form>
		</div>
	</div>
</div>