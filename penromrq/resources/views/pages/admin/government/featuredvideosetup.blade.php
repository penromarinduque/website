@extends('layouts.layout')

@section('title', 'Add Photo Releases')

@section('content')

<section class="content-header">
	<h1>
		<i class="fa fa-box"></i> Add Photo Releases
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="{{ route('website.route',['path' => $path]) }}"><i class="fa fa-box"></i> Center Panel </a> </li>
		<li class="active"> <i class="fa fa-box"></i> Add Featured Video </li>
	</ol>
</section>

<style type="text/css">
	.box-shadow{
	 	box-shadow: 1px 2px 5px 2px #999;
	}

	.border-light{
		box-shadow: 0.9px 1px 3px 3px #f7f5f5;
	}

	.padding-t20
	{
		padding-top: 20px; 
	}

	.padding-b20
	{
		padding-bottom: 20px; 
	}

	.box-shadow-btm
	{
		box-shadow: 0 4px 10px -2px #e6e6e6 !important;
	}

	.margin-t50
	{
		margin-top: 50px;
	}
</style>

<div class="content">
	@include('errors.alerts')
	<div class="box box-primary">
		<div class="box-header with-border" style="padding: 20px 10px 20px; box-shadow: 0 4px 5px -2px #f7f5f5;">
			<h3 class="box-title">
				<a href="{{ route('website.route',['path' => $path]) }}?{{ request()->previous }}" data-toggle="tooltip" data-placement="right" title="Back to table"><i class="fa fa-arrow-left fa-fw"></i> Back </a>
			</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
            <div class="panel-body">
							@include('pages.admin.government.forms.formaddimageandvideos',['center' => $center, 'video' => true])
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	function checkVideoImageType(value) {
		if(value == 'I') {
			$('.image-type').css('display','block');
			$('.video-type').css('display','none');
			$('#created_image').attr('required',true);
		} else {
			$('.video-type').css('display','block');
			$('.image-type').css('display','none');
			$('#created_image').attr('required',false);
		}
	}
</script>	

@endsection