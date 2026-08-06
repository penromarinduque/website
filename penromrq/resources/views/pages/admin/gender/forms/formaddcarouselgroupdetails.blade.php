<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-create-carousel-group-details' , 'id' => Crypt::encrypt('') ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								CATEGORY: 
							</td>
							<td style="padding: 0px;">
								<select type="text" name="group_id" class="form-contro input-sm" style="width: 100%; border-radius: 0px;" required>
								    <option value=""> Select Carousel Group </option>
								    @foreach( app('GenderCarouselGroup')->where('status','1')->get() as $key => $value)
								    <option value="{{ Crypt::encrypt($value->group_id) }}"> {{ $value->group_code }} - {{ $value->group_name }}</option>
								    @endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								UPLOAD IMAGE: 
							</td>
							<td style="padding: 0px;">
								<input type="file" name="carousel_path" class="form-control input-sm">
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								DESCRIPTION: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="carousel_text" autocomplete="off" required>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								BUTTON TEXT: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="carousel_button_text" autocomplete="off" required>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
								BUTTON LINK: 
							</td>
							<td style="padding: 0px;">
								<input type="text" class="form-control input-sm" name="carousel_link" autocomplete="off" required>
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