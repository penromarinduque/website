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
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="" onclick="return false;"> E-Library </a></li>
						<li class="breadcrumb-item active"> Indicative Calendar of Events </li>
					</ol>
				</nav>
			</div>
			@foreach($panel as $key => $value)
			<div class="col-md-12">
		    <div class="panel panel-default">
	        <div class="panel-heading bg-green">
	            <h3 class="panel-title text-white text-center" style="font-size: 12pt;"><b> {{ $value->panel_name }} </b></h3>
	        </div>
	        <div class="panel-body">
            <div class="row">
              @foreach($value->details as $key => $details)
                @if($details->panel_dtl_type == '1')
                	<div class="col-md-4">
                		<a href="{{ $details->storage->file_link }}" target="_blank">
                			<img src="{{ asset($details->storage->file_path) }}" style="width: 100%; height: auto; min-width: 200px; min-height: 250px;">
                		</a>
                  </div>
                @endif
              @endforeach
 	 					</div>
	        </div>
		    </div>
			</div>
			@endforeach
		</div>
	</div>
</div>

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection