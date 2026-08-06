@extends('layouts.layout')

@section('title', 'Top Navigation Setup')

@section('content')

<section class="content-header">
	<h1> &nbsp;</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Special Page Setup </li>
	</ol>
</section>

<div class="content">

	@include('errors.alerts')

	<div class="box box-primary">
		<form method="post" action="{{ route('website.route',['path' => 'top-navigation-setup', 'action' => 'admin-update-users-special-navmenu' , 'id' => Crypt::encrypt('1')]) }}"> {{ csrf_field() }}
			<div class="box-header with-border">
				<h3 class="box-title"> 
					<i class="fa fa-list-ul"></i> SPECIAL PAGE SETUP
					<small> Control panel </small> 
				</h3>
				<div class="box-tools text-right">
					<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaladdnavmenu"> 
					    <i class="fa fa-plus fa-fw"></i> CREATE 
					</button>
					<button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save your changes?')"> 
					    <i class="fa fa-save fa-fw"></i> UPDATE 
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div style="height: 73vh; overflow-x: auto;">
							<table class="table table-bordered">
								<thead>
									<tr style="font-size: 12px;">
										<th class="text-center" style="width: 30px;">
											<input type="checkbox" id="checkall" name="" style="vertical-align: middle; width: 15px; height: 15px;">
										</th>
										<th class="text-center" style="width: 230px;"> DESCRIPTION </th>
										<th class="text-center" style="width: 150px;"> PARENT </th>
										<th class="text-center" style="width: 230px;"> LINK </th>
										<th class="text-center" style="width: 150px;"> BASE PATH </th>
										<th class="text-center" style="width: 150px;"> BLADE </th>
										<th class="text-center" style="width: 150px;"> TAB TYPE </th>
										<th class="text-center" style="width: 150px;"> DROP TYPE </th>
										<th class="text-center" style="width: 50px;">  ASC </th>
										<th class="text-center"> <i class="fa fa-remove"></i> </th>
									</tr>
								</thead>
								<tbody>
									@include('pages.admin.government.navigationdetails', [ 'class' => $navheader3 , 'head_id' => '3'])
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@include('pages.admin.government.modal.modaladdnavmenu', ['head_id' => '3'])
@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('#checkall').on('click',function(){
			if($(this).is(':checked')){
				$('.checkbox').prop('checked',true);
			}else{
				$('.checkbox').prop('checked',false);
			}
		});
	});
</script>
@endpush
@endsection

