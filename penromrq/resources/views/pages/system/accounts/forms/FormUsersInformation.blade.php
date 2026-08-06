<style type="text/css">
	.info-input {  display: none; }
</style>
<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'accounts-update-users-info','id' => encrypt($thisUserAccount->users_id)]) }}"> {{ csrf_field() }}
	<div class="box box-default">
		<div class="box-header with-border" style="padding-top: 20px; padding-bottom: 20px;">
			<h3 class="box-title"> <i class="fa fa-user fa-fw"></i> Personal Info </h3>
			<div class="box-tools pull-right">
				<label style="margin-right: 20px;">
					<input type="checkbox" id="btn_edit" style="height: 16px; width: 16px; position: absolute; top: 1px; left: -20px;"> Edit
				</label>
				<button type="submit" id="btn_save" class="btn btn-primary btn-sm" disabled>
					<i class="fa fa-check fa-fw"></i> Save </button>
			</div>
		</div>
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="fname" class="col-sm-3 control-label"> Firstname: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->firstname }}</span>
						<input type="text" class="form-control info-input" name="firstname" id="fname" value="{{ $thisUserAccount->firstname }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="mname" class="col-sm-3 control-label"> Middlename: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->middlename }}</span>
						<input type="text" class="form-control info-input" name="middlename" id="mname" value="{{ $thisUserAccount->middlename }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="lname" class="col-sm-3 control-label"> Lastname: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->lastname }}</span>
						<input type="text" class="form-control info-input" name="lastname" id="lname" value="{{ $thisUserAccount->lastname }}" required>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label for="position_title" class="col-sm-3 control-label"> Occupation: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->position_title }}</span>
						<input type="text" class="form-control info-input" name="position_title" id="position_title" value="{{ $thisUserAccount->position_title }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="contact" class="col-sm-3 control-label"> Contact No: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->contact }}</span>
						<input type="text" class="form-control info-input" name="contact" id="contact" value="{{ $thisUserAccount->contact }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label"> Email Address: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->email }}</span>
						<input type="text" class="form-control info-input" name="email" id="email" value="{{ $thisUserAccount->email }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="birthdate" class="col-sm-3 control-label"> Date of Birth: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ date('m/d/Y',strtotime($thisUserAccount->birthdate)) }}</span>
						<input type="date" class="form-control info-input" name="birthdate" id="birthdate" value="{{ $thisUserAccount->birthdate }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="col-sm-3 control-label"> Complete Address: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->address }}</span>
						<textarea class="form-control info-input" name="address" id="address" style="resize: vertical; min-height: 100px;" required>{{ $thisUserAccount->address }}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="education" class="col-sm-3 control-label"> Education: </label>
					<div class="col-sm-9">
						<span class="form-control info-text">{{ $thisUserAccount->education }}</span>
						<textarea class="form-control info-input" name="education" id="education" style="resize: vertical; min-height: 100px;" required>{{ $thisUserAccount->education }}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>