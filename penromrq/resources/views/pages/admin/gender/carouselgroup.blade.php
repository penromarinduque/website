@extends('layouts.layout')
@section('title', 'GAD | Carousel Group')
@section('content')
<section class="content-header">
	<h1> &nbsp; </h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> Carousel Group </li>
	</ol>
</section>
<section class="content">
	@include('errors.alerts')
	<div class="box box-primary">
		<div class="box-body" id="users_box" style="min-height: 75vh;">
			<div class="panel panel-default">
				<div class="panel-heading clearfix" style="background-color: white;">
					<h3 class="panel-title pull-left">
					<label><i class="fa fa-list"></i> CAROUSEL GROUP SETUP </label>
					</h3>
				</div>
				<div class="panel-body">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#allgroup" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL GROUP </b></a></li>
							<li><a href="#newgroup" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD NEW GROUP </b></a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active fade in" id="allgroup">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center"> GROUP </th>
										<th class="text-center"> DESCRIPTION </th>
										<th class="text-center"> STATUS </th>
										<th class="text-center"> ACTION </th>
									</tr>
								</thead>
								<tbody>
									@foreach($carousel_group as $key => $value)
									<tr>
										<td style="vertical-align: middle;"> {{ $value->group_code }} </td>
										<td style="vertical-align: middle;"> {{ $value->group_name }} </td>
										<td class="text-center" style="min-width: 100px; vertical-align: middle;">
											<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->group_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-carousel-group', 'id'
											=> Crypt::encrypt($value->group_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
										</td>
										<td class="text-center" style="min-width: 100px;">
											<a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-edit-carousel-group', 'id' => Crypt::encrypt($value->group_id) ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
											<a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-delete-carousel-group', 'id' => Crypt::encrypt($value->group_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')"class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="newgroup">
							@include('pages.admin.gender.forms.formaddcarouselgroup')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
<script type="text/javascript">
	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			tooglestatus(url,0);
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			tooglestatus(url,1);
		}
	}
	function tooglestatus(url,stat)
	{
		$.get(url,{status:stat},function(count){ });
	}
</script>
@endpush
@endsection