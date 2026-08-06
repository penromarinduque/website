<div class="modal fade" id="modalselectpanelgroup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><i class="fa fa-photo"></i> SELECT PANEL </h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>DESCRIPTION</tr>
					</thead>
					<tbody>
						@foreach($webdata->gender_retrieve_panel_group(3) as $key => $value)
						<tr ondblclick="return selectedPanel(this)" data-panel="{{ $value->panel_id }}" style="cursor: pointer;">
							<td>{{ $value->panel_name }}</td>
						</tr>
               			@endforeach
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
			</div>
		</div>
	</div>
</div>
