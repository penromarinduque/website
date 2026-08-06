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
					<li class="text-center" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Company </a>
					</li>
					<li class="text-center" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-module', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Module </a>
					</li>
					<li class="text-center active" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-window', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Window </a>
					</li>
					<li class="text-center" style="width: 24%;">
						<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-method', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Method/Role </a>
					</li>
				</ul>
				<div class="tab-content">
					<form method="post" id="form_search_users_window"> {{ csrf_field() }}
						<table class="table table-bordered">
							<tr>
								<td colspan="2">
									<div class="text-right">
										<button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
										<button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
										<button type="button" class="btn btn-primary btn-sm" onclick="updateUsersWindow()"><i class="fa fa-save"></i> UPDATE </button>
									</div>
								</td>
							</tr>
							<tr style="white-space: nowrap;">
								<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 20%;">
									SELECT COMPANY: 
								</td>
								<td style="padding: 0px;" colspan="3">
									<select class="form-control input-sm" id="company_id" name="company_id" onchange="return selectedCompany(this)" required>
							            @foreach($usersCompany as $key => $value)
							            <option value="{{ $value->company_id }}" {{ ($value->company_id == $thisUserAccount->company_id) ? 'selected' : ''}}> {{ strtoupper($value->company_code) }} - {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUserAccount->company_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
							            @endforeach
							        </select>
								</td>
							</tr>
							<tr style="white-space: nowrap; display: none;">
								<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
									SELECT WINDOW FROM:
								</td>
								<td style="padding: 0px;" colspan="3">
									<select class="form-control input-sm" id="module_from" name="module_from">
							            @foreach($usersModule as $key => $value)
							            <option value="{{ $value->module_id }}" {{ ($value->module_id == $moduleTo->module_id) ? 'selected' : ''}}> {{ strtoupper($value->module_description) }} {{ ($value->module_id == $moduleTo->module_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
							            @endforeach
							        </select>
								</td>
							</tr>
							<tr style="white-space: nowrap;">
								<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
									SELECT MODULE: 
								</td>
								<td style="padding: 0px;" colspan="3">
									<select class="form-control input-sm" id="module_to" name="module_to" required>
							            @foreach($usersModule as $key => $value)
							            <option value="{{ $value->module_id }}" {{ ($value->module_id == $moduleTo->module_id) ? 'selected' : ''}}> {{ strtoupper($value->module_description) }} {{ ($value->module_id == $moduleTo->module_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
							            @endforeach
							        </select>
								</td>
							</tr>
						</table>
	              	</form>
					<form method="post" id="form_users_window_access">
						@include('pages.system.accounts.includes.TableUsersWindowAccess',['allWindow' => []])
		            </form>
				</div> <!-- /.tab-content -->
			</div><!-- /.nav-tabs-custom -->
		</div><!-- /.col -->
	</div> <!-- /.row -->
</div>
@push('scripts')
<script type="text/javascript">

	$(document).ready(function(){
		$('form').on('submit',function(e){
			e.preventDefault();
		});
		$('input,select,textarea').on('change',function(e){
			if($.trim($(this).val()) != "") {
	    		$(this).css('border-color','');
	    	}
	    });
	});

	function selectAllCheckbox(event) {
		if($(event).attr('checked')) {
			$('.method-checkbox').prop('checked',false);
			$(event).removeAttr('checked');
			$(event).html('<i class="fa fa-square"></i> SELECT');
		} else {
			$('.method-checkbox').prop('checked',true);
			$(event).attr('checked',true);
			$(event).html('<i class="fa fa-check-square"></i> SELECT');
		}
	}

	function selectedCompany(event, option = '') {
        $.ajax({
            url : '{{ route('accounts.route',['path' => $path, 'action' => 'retrieve-users-module-json', 'id' => encrypt($thisUserAccount->users_id)]) }}',
            method : "post",
            data : { 'company_id' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
            	option += '<option value=""> SELECT MODULE </option>';
                if(data.length > 0 ){
                	$.each( data, function(key,value) {
	                    option += '<option value="' + value.module_id + '">' + value.module_description + '</option>';
	                });
	                $('#module_to').attr('disabled',false);
               		$('#module_to').html(option);
	                $('#module_from').attr('disabled',false);
               		$('#module_from').html(option);
                } 
            }
        });
	}	

    function submitFormSearch() {
		$('.box-overlay-loader').show();
		$.ajax({
		    url : '{{ route('accounts.route',['path' => $path,'action' => 'search-users-window','id' => encrypt($thisUserAccount->users_id)]) }}',
		    method : "post",
		    data: new FormData($('#form_search_users_window')[0]),
		    contentType: false,
		    cache: false,
		    processData: false,
		    success : function(data) {
		    	$('#form_users_window_access').html(data);
		    	$('.box-overlay-loader').hide();
		    }
		});
    }

    function updateUsersWindow(event, option = '') {
    	$('.box-overlay-loader').show();
        $.ajax({
            url : '{{ route('accounts.route',['path' => $path,'action' => 'update-users-window','id' => encrypt($thisUserAccount->users_id)]) }}',
            method : "post",
            data: new FormData($('#form_users_window_access')[0]),
            contentType: false,
            cache: false,
            processData: false,
            success : function(data) {
            	alert('Successfully Updated.');
            	$('.box-overlay-loader').hide();
            	submitFormSearch();
            }
        });
    }
</script>
@endpush
@endsection


