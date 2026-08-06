<div class="modal fade" id="modalnavigationimage{{ $value->nav_id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><i class="fa fa-photo"></i> NAVIGATION IMAGE </h4>
			</div>
			<div class="modal-body">
				<img src="{{ asset($value->nav_logo_path) }}" style="width: 100%; height: auto;">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
			</div>
		</div>
	</div>
</div>