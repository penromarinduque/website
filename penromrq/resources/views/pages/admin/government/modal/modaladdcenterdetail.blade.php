<div class="modal fade" id="{{ $id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" action="{{ route('create.center.detail') }}" enctype="multipart/form-data"> {{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"> Detail Setup </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label> Image </label>
						<input type="file" class="form-control" name="image">
					</div>
					<div class="form-group">
						<label> Create Story </label>
						<textarea class="textarea" name="wysihtml5" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
					<div class="form-group">
						<label> Created By </label>
						<input type="text" class="form-control" name="create_by" required>
					</div>
					<div class="form-group">
						<label> Created Date </label>
						<input type="date" class="form-control" name="create_date" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
				</div>
			</form>
		</div>
	</div>
</div>