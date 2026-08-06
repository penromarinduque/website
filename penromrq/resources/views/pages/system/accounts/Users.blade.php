@extends('layouts.layout')
@section('title', $windowName)
@section('content')
@include('pages.system.accounts.includes.WindowBreadCrumbs')
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
                            <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL USER ACCOUNT </b></a></li>
                            <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD USER ACCOUNT </b></a></li>
                        </ul>
                    </div>
                    @include('pages.system.accounts.forms.FormSearchUsersAccount')
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="list">
                            @include('pages.system.accounts.includes.TableUsersAccount')
                        </div>
                        <div class="tab-pane fade" id="add">
                            @include('pages.system.accounts.forms.FormCreateUsersAccount')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
	$('form').on('submit',function(e,collect = ''){
		$('.box-overlay-loader').show();
		$.ajax({
			url: this.action,
			method:"POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#users_table #users_table_body').html(data);
				$('.box-overlay-loader').hide();
			}
		})
		e.preventDefault();
	});

	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(count){
				alert(count);
			});
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(count){
				alert(count);
			});
		}
	}

	function deleteFrontline(evt,fid)
	{	
		if(confirm('Are you sure you want to delete this row?')){
			$.get('/delete/frontline/'+evt+'/'+fid,function(data){ $('#'+data).parent().parent().fadeOut(1000); });
		}
	}
</script>
@endpush
@endsection

