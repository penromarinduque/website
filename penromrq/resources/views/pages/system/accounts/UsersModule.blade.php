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
						<li class="text-center active" style="width: 24%;">
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
						<form method="post" id="form_search_users_module"> {{ csrf_field() }}
							<table class="table table-bordered">
								<tr>
									<td colspan="2">
										<div class="text-right">
											<button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
											<button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
											<button type="button" class="btn btn-primary btn-sm" onclick="updateUsersModule()"><i class="fa fa-save"></i> UPDATE </button>
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
							</table>
		              	</form>
						<form method="get" id="form_update_users_module" action="{{ route('accounts.route',['path' => $path,'action' => 'update-users-module','id' => encrypt($thisUserAccount->users_id)]) }}">
							@include('pages.system.accounts.includes.TableUsersModuleAccess')
			            </form>
					</div> <!-- /.tab-content -->
				</div><!-- /.nav-tabs-custom -->
			</div><!-- /.col -->
		</div> <!-- /.row -->
	</div>
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
            url : '{{ route('accounts.route',['path' => $path, 'action' => 'retrieve-users-module', 'id' => encrypt($thisUserAccount->users_id)]) }}',
            method : "post",
            data : { 'company_id' : event.value },
            processData : true,
            dataType : 'html',
            cache : false,
            success : function(data) {
            	$('#form_update_users_module').html(data);
            }
        });
	}

	function selectedUser(event, option = ''){
		submitFormSearch();
	}

	function submitFormSearch(countRequired = 0) {
	
		$('#form_search_users_module input,select,textarea').each(function(index,value){
			if($(this).prop('required') && $(this).val() == ""){
				countRequired += + 1;
				$(this).css('border-color','red');
			}
		});

		if(countRequired == 0) {
			$('.box-overlay-loader').show();
			$.ajax({
			    url : '{{ route('settings.route', ['path' => $path, 'action' => 'settings-search-users-module', 'id' => encrypt('')]) }}',
			    method : "post",
			    data: new FormData($('#form_search_users_module')[0]),
			    contentType: false,
			    cache: false,
			    processData: false,
			    success : function(data) {
			    	$('#panel_body').html(data);
			    	$('.box-overlay-loader').hide();
			    }
			});
		} else {
			alert('Fields is required.');
		}
	}

    function updateUsersModule() {
    	$('.box-overlay-loader').show();
        $.ajax({
            url : $('#form_update_users_module').attr('action'),
            method : "post",
            data: new FormData($('#form_update_users_module')[0]),
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

	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(count){
				
			});
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(count){
				
			});
		}
	}
</script>
@endpush
@endsection


