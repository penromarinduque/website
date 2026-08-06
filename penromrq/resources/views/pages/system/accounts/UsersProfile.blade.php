@extends('layouts.layout')
@section('title', $windowName)
@section('content')
@include('pages.system.accounts.includes.WindowBreadCrumbs')
<div class="content">
	@include('errors.alerts')
	<div class="row">
		@include('pages.system.accounts.includes.UsersAccessTab')
	  	<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-profile-photo','id' => encrypt($thisUserAccount->id) ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
						<img class="profile-user-img img-responsive img-circle" src="{{ asset($thisUserAccount->profile_path) }}" alt="User profile picture" style="height: 150px; width: 150px;">
						<h3 class="profile-username text-center">
							{{ $thisUserAccount->firstname }} {{ $thisUserAccount->middlename }} {{ $thisUserAccount->lastname }}
						</h3>
						<p class="text-muted text-center">{{ $thisUserAccount->position_title }}</p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<input type="file" name="change_profile" class="form-control" required="">
							</li>
						</ul>
						<button type="submit" class="btn btn-primary btn-block"><b>Change Profile</b></button>
					</form>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">About Me</h3>
				</div>
				<div class="box-body">
					<strong><i class="fa fa-book margin-r-5"></i> Education </strong>
					<p class="text-muted"> {{ $thisUserAccount->education }} </p> <hr>
					<strong><i class="fa fa-map-marker margin-r-5"></i> Location </strong>
					<p class="text-muted"> {{ $thisUserAccount->address }} </p> <hr>
					<strong><i class="fa fa-envelope margin-r-5"></i> Email </strong>
					<p> {{ $thisUserAccount->email }} </p> <hr>
					<strong><i class="fa fa-phone margin-r-5"></i> Contact </strong>
					<p> {{ $thisUserAccount->contact }} </p>
				</div>
			</div>
		</div> 
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs" style="height: 80px;">
					<li style="width: 20%;" class="active">
						<a href="#activity" data-toggle="tab"><i class="fa fa-edit fa-fw"></i> Information </a>
					</li>
					<li style="width: 20%;">
						<a href="#security" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> Security </a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="activity">
						@include('pages.system.accounts.forms.FormUsersInformation')
					</div>
					<div class="tab-pane" id="security">
						@include('pages.system.accounts.forms.FormUsersCredential')
					</div>
				</div> 
			</div>
		</div>
	</div> 
</div>
@push('scripts')
<script type="text/javascript">
	$('#btn_edit').on('click',function(){
		if($(this).is(':checked')){
			$('#btn_save').attr('disabled',false);
			$('.info-text').hide();
			$('.info-input').show().css('border-color','darkgreen');
			$('.info-input')[0].focus();
		}else{
			$('#btn_save').attr('disabled',true);
			$('.info-text').show();
			$('.info-input').hide();
		}
	});
</script>
@endpush
@endsection

