@extends('pages.website.government.includes.layout')

@section('content')

@include('pages.website.government.includes.topnav')

@include('pages.website.government.includes.masterhead')

<div class="container-fluid bg-gray">
	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="/"> Home </a></li>
						<li class="breadcrumb-item active"><a style="color: green; text-decoration: none;" href="#" onclick="return false;"> News and Events </a></li>
					</ol>
				</nav>
			</div>

			<style type="text/css">
				.created-title
				{
					font-size: 16pt;
					font-weight: bold;
					text-align: center;
				}
				.created-images img
				{
					width: 100%;
				}
				.published-by
				{
					padding: 10px;
					font-size: 14pt;
				}
			</style>

			<div class="col-lg-12">
				<div class="panel panel-success">
					<div class="panel-heading bg-green">
						<h1 class="panel-title text-white"><b> NEWS AND EVENTS </b></h1>
					</div>
					<div class="panel-body">
						@foreach(app('CenterBarDetails')->where('center_id','1')->paginate(10) as $key => $value)

							<div class="created-images">
								<img src="{{ asset($value->created_image) }}">
							</div>

							<p class="created-title">{{ $value->created_title }}</p>

							<p class="published-by">{{ $value->published_by }}</p>

							<p>{!! $value->created_story !!}</p>

						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection