<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-edit-center-panel-image-video', 'id' => Crypt::encrypt($center->content_id) ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="form-group">
		<label> SELECT TYPE </label>
		<select class="form-control" name="vid_img_flag" onchange="return checkVideoImageType(this.value)">
			<option value="I" @if($center->vid_img_flag == 'I') selected @endif> IMAGE TYPE </option>
			<option value="V" @if($center->vid_img_flag == 'V') selected @endif> VIDEO TYPE </option>
		</select>
	</div>
	<div class="form-group">
		<label> DESCRIPTION </label>
		<textarea class="form-control" name="created_title" style="resize: vertical;" required>@if( old('created_title') ){{ old('created_title') }}@else{{ $center->vid_img_title }}@endif</textarea>
	</div>
	<div class="form-group">
		<label> YOUTUBE / IMAGE LINK </label>
		<input type="text" class="form-control" name="link" autocomplete="off" value="{{ $center->vid_img_link }}" required>
	</div>
	<div class="form-group image-type" style="display: @if($center->vid_img_flag == 'V') none; @endif">
		<label> UPLOAD FILE / THUMBNAIL </label>
		<input type="file" class="form-control" id="created_image" name="image">
	</div>
	<div class="form-group">
		<label> PUBLISHED BY </label>
		<input type="text" class="form-control" name="published_by" value="{{ $center->published_by }}" autocomplete="off" required>
	</div>
	<div class="form-group">
		<label> PUBLISHED DATE </label>
		<input type="date" class="form-control" name="published_date" value="@if(old('create_date')){{ old('create_date') }}@else{{ date('Y-m-d', strtotime($center->published_date)) }}@endif" required>
	</div>
	<div class="form-group text-right">
		<button class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT </button>
	</div>
	<div class="form-group" style="display: none;">
		<label style="cursor: pointer;"> EMBEDED VIDEO (YouTube) </label>
		<textarea name="wysihtml5" placeholder="Place embeded code here. Make sure you set the width to 100% to make it responsive." style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
	</div>
</form>