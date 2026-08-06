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
                            <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL MODULE </b></a></li>
                            <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD MODULE </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="list">
                            @include('pages.system.settings.includes.TableSystemModule')
                        </div>
                        <div class="tab-pane fade" id="add">
                            @include('pages.system.settings.forms.FormCreateModule')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
	function submitFormSearch(event) {
		$.ajax({
		    url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-search-system-module', 'id' => Crypt::encrypt('')]) }}',
		    method : "post",
		    data : new FormData($('#form_search_system_module')[0]),
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function(data) {
		    	$('#panel_body').html(data);
		    }
		});
	}
	function updateSystemModule(form) {
		$('.box-overlay-loader').show();
		if(confirm('Are you sure you want to update system module?')) {
			$.ajax({
			    url: '{{ route('settings.route',['path' => $path, 'action' => 'settings-update-system-module', 'id' => Crypt::encrypt('')]) }}',
			    method:"POST",	
			    data: new FormData($('#form_update_system_module')[0]),
			    contentType: false,
			    cache: false,
			    processData: false,
			    success: function(data) {
			    	alert('Successfully Updated');
			    	$('#panel_body').html(data);
			    	submitFormSearch();
			    	$('.box-overlay-loader').hide();
			    }
			});
		}
	}
	function deleteSystemModule(form) {
		if(confirm('Are you sure you want to PERMANENTLY delete this row?')) {
			// $.ajax({
			//     url: '{{ route('settings.route',['path' => $path, 'action' => 'settings-delete-system-module', 'id' => Crypt::encrypt('')]) }}',
			//     method:"POST",
			//     data: new FormData($('#form_update_system_module')[0]),
			//     contentType: false,
			//     cache: false,
			//     processData: false,
			//     success: function(data) {
			//     	$('#panel_body').html(data);
			//     }
			// });
		}
	}
</script>
@endpush
@endsection
