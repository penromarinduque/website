<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-create-carousel-group' , 'id' => Crypt::encrypt('') ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								GROUP CODE: 
							</td>
							<td style="padding: 0px;">
								<input type="text" name="group_code" class="form-control input-sm" autocomplete="off" required>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								GROUP DESCRIPTION: 
							</td>
							<td style="padding: 0px;">
								<input type="text" name="group_description" class="form-control input-sm" autocomplete="off" required>
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