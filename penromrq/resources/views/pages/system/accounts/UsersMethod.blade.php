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
                    <li class="text-center" style="width: 24%;">
                        <a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-window', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Window </a>
                    </li>
                    <li class="text-center active" style="width: 24%;">
                        <a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-method', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Method/Role </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <form method="post" id="form_search_users_method"> {{ csrf_field() }}
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
                                        <button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="updateUserModule()"><i class="fa fa-save"></i> UPDATE </button>
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
                            <tr style="white-space: nowrap;">
                                <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
                                    SELECT MODULE:
                                </td>
                                <td style="padding: 0px;" colspan="3">
                                    <select class="form-control input-sm" id="module_from" name="module_from" onchange="submitFormSearch()">
                                        @foreach($usersModule as $key => $value)
                                        <option value="{{ $value->module_id }}" {{ ($value->module_id == $moduleTo->module_id) ? 'selected' : ''}}> {{ strtoupper($value->module_code) }} - {{ strtoupper($value->module_description) }} {{ ($value->module_id == $moduleTo->module_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="white-space: nowrap;">
                                <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
                                    SELECT WINDOW: 
                                </td>
                                <td style="padding: 0px;" colspan="3">
                                    <select class="form-control input-sm" id="module_to" name="module_to" onchange="submitFormSearch()">
                                        <option value="" selected>-- SELECT WINDOW --</option>
                                        @foreach($moduleWindow as $key => $value)
                                        <option value="{{ strtoupper($value->menu_id) }}"> {{ strtoupper($value->menu_name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <form method="get" action="{{ route('accounts.route',['path' => $path,'action' => 'accounts-update-users-window','id' => encrypt($thisUserAccount->users_id)]) }}">
                        <div style="overflow-y: auto;">
                            @include('pages.system.accounts.includes.TableUsersWindowMethodAccess')
                        </div>
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
            url : '{{ route('settings.route',['path' => 'users-company-access', 'action' => 'settings-retrieve-company-users', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'company' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                option += '<option value=""> SELECT USER </option>';
                if(data.length > 0 ){
                    $.each( data, function(key,value) {
                        option += '<option value="' + value.encrypted_id + '">' + value.firstname + ' '+ value.lastname + '</option>';
                    });
                    $('#users_id').attr('disabled',false);
                    $('#users_id').html(option);
                } else {
                    $('#users_id').attr('disabled',true);
                    $('#users_id').html(option);
                }
            }
        });
    }

    function selectedModule(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => 'create-users-method', 'action' => 'settings-retrieve-window-classes', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'module' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                option += '<option value=""> SELECT CLASS </option>';
                if(data.length > 0 ){
                    $.each( data, function(key,value) {
                        option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
                    });
                    $('#menu_parent').attr('disabled',false);
                    $('#menu_parent').html(option);
                    $('#menu_child').attr('disabled',true);
                    $('#menu_child').html('<option value=""> SELECT SUB-CLASS </option>');
                } else {
                    $('#menu_parent').attr('disabled',true);
                    $('#menu_parent').html(option);
                }
                submitFormSearch();
            }
        });
    }

    function selectedUser(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-retrieve-users-module', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'users_id' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                option += '<option value=""> SELECT MODULE </option>';
                if(data.length > 0 ){
                    $.each( data, function(key,value) {
                        option += '<option value="' + value.module_code + '">' + value.module_description + '</option>';
                    });
                    $('#module_id').attr('disabled',false);
                    $('#module_id').html(option);
                } else {
                    $('#module_id').attr('disabled',true);
                    $('#module_id').html(option);
                }
            }
        });
    }

    function selectedClass(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => 'create-users-method', 'action' => 'settings-retrieve-window-sub-class', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'parent' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                option += '<option value=""> SELECT SUB-CLASS </option>';
                if(data.length > 0 ){
                    $.each( data, function(key,value) {
                        option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
                    });
                    $('#menu_child').attr('disabled',false);
                    $('#menu_child').html(option);
                } else {
                    $('#menu_child').attr('disabled',true);
                    $('#menu_child').html(option);
                }
                submitFormSearch();
            }
        });
    }

    function selectedSubClass(event, option = '') {
        submitFormSearch();
    }

    function submitFormSearch(countRequired = 0) {
    
        $('#form_search_users_method input,select,textarea').each(function(index,value){
            if($(this).prop('required') && $(this).val() == ""){
                countRequired += + 1;
                $(this).css('border-color','red');
            }
        });

        if(countRequired == 0) {
            $('.box-overlay-loader').show();
            $.ajax({
                url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-search-users-method', 'id' => Crypt::encrypt('')]) }}',
                method : "post",
                data: new FormData($('#form_search_users_method')[0]),
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

    function updateUserMethod(event, option = '') {
        $('.box-overlay-loader').show();
        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-update-users-method', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data: new FormData($('#form_update_users_method')[0]),
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
