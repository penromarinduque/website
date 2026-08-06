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
					font-size: 18pt;
					font-weight: bold;
					text-align: center;
					color: green;
				}
				.created-images img
				{
					width: 100%;
					height: 460px;
				}
				.published-by
				{
					padding: 15px 0px;
					font-size: 12pt;
				}
				.created-paragraph p img {
					width: 100%;
					height: 460px;
				}
			</style>
			<div class="col-lg-12">
				<div class="panel panel-success">
					<div class="panel-heading bg-green">
						<h1 class="panel-title text-white"><b> NEWS AND EVENTS </b></h1>
					</div>
					<div class="panel-body">
						@foreach($details as $key => $value)
							<p class="created-title">{{ $value->created_title }}</p>
							<div class="created-images">
								<div id="myCarousel3" class="carousel slide carousel-custom" data-ride="carousel">
								    <div class="carousel-inner text-center" role="listbox">
								    	<div class="item active">
									    	<img src="{{ asset($value->created_image) }}" style="width: 100%; height: 460px;">
									    </div>
									    @foreach($value->otherimage()->get() as $key => $image)
							        	<div class="item">
							    	    	<img src="{{ asset($image->vid_img_path) }}" style="width: 100%; height: 460px;">
							    	    </div>
									    @endforeach
								    </div>
								    <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
								        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								        <span class="sr-only">Previous</span>
								    </a>
								    <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
								        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								        <span class="sr-only">Next</span>
								    </a>
								</div>
							</div>
							<div class="created-paragraph" style="text-align: justify;">
								{!! $value->created_story !!}
							</div>
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
