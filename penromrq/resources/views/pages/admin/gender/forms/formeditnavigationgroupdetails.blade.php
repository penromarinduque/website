<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-update-navigation-group-details' , 'id' => Crypt::encrypt($group_details->detail_id) ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DETAIL GROUP:
							</td>
							<td style="padding: 0px;">
								<select type="text" name="group_id" class="form-contro input-sm" style="width: 100%; border-radius: 0px;" required>
								    <option value=""> Select Navigation Group </option>
								    @foreach( app('GenderNavBar')->where('status','1')->get() as $key => $value)
								    <option value="{{ Crypt::encrypt($value->nav_id) }}" @if($value->nav_id == $group_details->nav_id) selected @endif> {{ $value->nav_id }} - {{ $value->nav_description }} </option>
								    @endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DETAIL PARENT: 
							</td>
							<td style="padding: 0px;">
								<select type="text" class="form-contro input-sm" name="detail_parent" style="width: 100%; border-radius: 0px;" onchange="setLevel(this)" required>
								    <option value="0"> Select Navigation Parent </option>
								    <option value="0"> 0 - Main Navigation Parent </option>
								    @foreach( app('GenderNavBarDetails')->where('detail_type','1')->where('status','1')->get() as $key => $value)
								    <option value="{{ Crypt::encrypt($value->detail_id) }}" @if($value->detail_id == $group_details->detail_parent) selected @endif> {{ $value->detail_id }} - {{ $value->detail_name }} </option>
								    @endforeach
								</select>

								<input type="hidden" name="detail_level" id="detail_level" value="{{ $group_details->detail_level }}">

								@push('scripts')
								<script type="text/javascript">
									function setLevel(evt) {
										var dataLevel = $(evt).find(':selected').data('level');
										$('#detail_level').val(dataLevel + 1);
									}
								</script>
								@endpush

							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DETAIL DESCRIPTION: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="detail_description" autocomplete="off" value="{{ $group_details->detail_name }}" required>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DETAIL PATH: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="detail_path" autocomplete="off" value="{{ $group_details->detail_path }}" required>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DETAIL BLADE: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="detail_blade" autocomplete="off" value="{{ $group_details->detail_blade }}" required>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DETAIL LINK: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="detail_link" autocomplete="off" value="{{ $group_details->detail_link }}" required>
							</td>
						</tr>
					</table>
				</div>
				<div class="panel-footer clearfix">
					<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i> UPDATE </button>
				</div>
			</div>
		</div>
	</div>
</form>`