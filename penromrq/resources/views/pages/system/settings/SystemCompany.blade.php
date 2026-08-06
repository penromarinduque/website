@extends('layouts.layout')
@section('title', $windowName)
@section('content')
@include('pages.system.settings.includes.WindowBreadCrumbs')
<section class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix bg-white">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL COMPANY </b></a></li>
                            <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD COMPANY </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="list">
                            @include('pages.system.settings.includes.TableSystemCompany')
                        </div>
                        <div class="tab-pane fade" id="add">
                            @include('pages.system.settings.forms.FormCreateCompany')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
    function selectModule(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => 'side-menu-setup', 'action' => 'settings-retrieve-active-windows', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'module' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                option += '<option value="0"> MAIN CLASS </option>';
                $.each( data, function(key,value) {
                    option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
                });
                $('#menu_parent').html(option);
            }
        });
    }
    function submitFormAddModule(form){
        $.ajax({
            url: $('#' + form).attr('action'),
            method:"POST",
            data: new FormData($('#' + form)[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var alert = document.createElement("DIV");
                alert.setAttribute("class", "alert alert-info");
                alert.innerHTML = "<button type='button' class='close alert-close' data-dismiss='alert' area-hidden='true'>&times;</button>";
                alert.innerHTML += "<label><i class='fa fa-warning'></i> " + data + "</label>";
                $('#modaladdmodule #modal_add_module_alert').html(alert);
                $('#' + form)[0].reset();
            }
        });
    }
</script>
@endpush 
@endsection