@extends('layouts.layout')
@section('title', $windowName)
@section('content')
@include('pages.system.accounts.includes.WindowBreadCrumbs')
<div class="content">
	@include('errors.alerts')
	<div class="row">
	  	<div class="col-md-3">
			@include('pages.system.accounts.includes.UsersAboutMe')
		</div> 
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="text-center active" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Company </a>
					</li>
					<li class="text-center" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-module', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Module </a>
					</li>
					<li class="text-center" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-window', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Window </a>
					</li>
					<li class="text-center" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-method', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Method/Role </a>
					</li>
				</ul>
				<div class="tab-content">
					<table class="table table-bordered">
						<tr>
							<td colspan="2">
								<div class="text-right">
									<button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
									<button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
									<button type="button" class="btn btn-primary btn-sm" onclick="updateUsersCompany()"><i class="fa fa-save"></i> UPDATE </button>
								</div>
							</td>
						</tr>
					</table>
					<form method="post" id="form_update_users_company" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}">
						<div style="overflow-y: auto;">
							@include('pages.system.accounts.includes.TableUsersCompanyAccess')
						</div>
		            </form>
				</div> <!-- /.tab-content -->
			</div><!-- /.nav-tabs-custom -->
		</div><!-- /.col -->
	</div> <!-- /.row -->
</div>
@push('scripts')
<script type="text/javascript">
	function updateUsersCompany() {
		$('.box-overlay-loader').show();
	    $.ajax({
	        url : $('#form_update_users_company').attr('action'),
	        method : "post",
	        data: new FormData($('#form_update_users_company')[0]),
	        contentType: false,
	        cache: false,
	        processData: false,
	        success : function(data) {
	        	alert('Successfully Updated.');
	        	$('.box-overlay-loader').hide();
	        }
	    });
	}
</script>
@endpush
@endsection

