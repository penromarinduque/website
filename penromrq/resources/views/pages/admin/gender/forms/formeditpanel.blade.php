<form method="post" id="formcreatepanel" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-update-panel' , 'id' => Crypt::encrypt($GenderPanel->panel_id) ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="row">
		<div class="col-md-6 col-md-offset-3" style="overflow-x: auto;">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								PANEL DESCRIPTION:
							</td>
						</tr>
						<tr>
							<td style="padding: 0px;">
								<input type="text" name="description" id="description" class="form-control input-sm" autocomplete="off" value="{{ $GenderPanel->panel_name }}" required>
							</td>
						</tr>
					</table>
				</div>
				<div class="panel-footer clearfix">
					<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i> SUBMIT </button>
				</div>
			</div>
		</div>
	</div>
</form>