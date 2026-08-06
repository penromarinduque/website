@extends('layouts.layout')

@section('title', 'Master Head Setup')

@section('content')

<section class="content-header">
	<h1> &nbsp;</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active"><i class="fa fa-folder-o fa-fw"></i> Header Setup </li>
	</ol>
</section>

<div class="content">

	@include('errors.alerts')

	<form action="{{ route('website.route',['path' => $path, 'action' => 'admin-edit-user-masterhead', 'id' => '1']) }}" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
		
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"> 
					<i class="fa fa-bars fa-fw"></i> HEADER SETUP
					<small> Control panel </small> 
				</h3>
				<div class="box-tools text-right">
					<button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save your changes?')"> 
						<i class="fa fa-save fa-fw"> </i>  UPDATE
					</button>
				</div>
			</div>
			<div class="box-body" style="height: 75vh">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="box-body">
								<div class="row">
									<div class="col-md-8">
										<label> MASTER HEAD </label>
										<div class="panel panel-default">
											<div class="panel-body" style="height: 207px;">
												<table class="table table-bordered">
													<tr>
														<td style="padding: 5px 0px 0px 10px; width: 30%;">
															<label style="font-size: 9pt; margin: 0px;" for="head_title"> NAME </label>
														</td>
														<td class="no-padding">
															<input type="text" class="form-control input-sm" id="head_title" name="head_title" required value="{{ $masterhead->head_title }}" autocomplete="off">
														</td>
													</tr>
													<tr>
														<td style="padding: 5px 0px 0px 10px; width: 30%;">
															<label style="font-size: 9pt; margin: 0px;" for="head_description"> DESCRIPTION </label>
														</td>
														<td class="no-padding">
															<input type="text" class="form-control input-sm" id="head_description" name="head_description" required value="{{ $masterhead->head_description }}" autocomplete="off">
														</td>
													</tr>
													<tr>
														<td style="padding: 5px 0px 0px 10px; width: 30%;">
															<label style="font-size: 9pt; margin: 0px;" for="head_tagline"> TAGLINE </label>
														</td>
														<td class="no-padding">
															<input type="text" class="form-control input-sm" id="head_tagline" name="head_tagline" required value="{{ $masterhead->head_tagline }}" autocomplete="off">
														</td>
													</tr>
													<tr>
														<td style="padding: 5px 0px 0px 10px; width: 30%;">
															<label style="font-size: 9pt; margin: 0px;" for="head_location"> LOCATION </label>
														</td>
														<td class="no-padding">
															<input type="text" class="form-control input-sm" id="head_location" name="head_location" required value="{{ $masterhead->head_location }}" autocomplete="off">
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="col-md-2 text-center">
										<label for="head_logo"> HEADER LOGO </label>
										<div>
											<img src="{{ asset($masterhead->head_logo) }}" alt="Header Logo" class="img-thumbnail">
											<input type="file" id="head_logo" class="form-control input-sm" name="head_logo">
										</div>
									</div>
									<div class="col-md-2 text-center">
										<label for="footer_logo"> FOOTER LOGO </label>
										<div>
											<img src="{{ asset($masterhead->footer_logo) }}" alt="Footer Logo" class="img-thumbnail">
											<input type="file" id="footer_logo" class="form-control input-sm" name="footer_logo">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

@endsection