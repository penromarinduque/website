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
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="" onclick="return false;"> Issuances </a></li>
						<li class="breadcrumb-item active"> Laws and Policies </li>
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
			            	<div class="col-md-12" style="overflow: auto;">
				            	<table class="table table-bordered table-condensed">

				            		<tr>
				            			<td class="col-sm-6 text-center"> <label> LAWS & POLICIES NUMBER </label> </td>
				            			<td class="col-sm-6 text-center"> <label> LAWS & POLICIES TITLE </label> </td>
				            		</tr>	

					                @foreach($value->details as $key => $details)

					                    @if($details->panel_dtl_type == '3')
					                        <tr>
					                        	<td class="text-center" style="vertical-align: middle;">
					                        		<h3>{{ $details->longtext->long_description }}</h3>
					                        	</td>
					                        	<td style="vertical-align: middle;">
					                        		{!! $details->longtext->long_text !!}
					                        	</td>
					                        </tr>
					                    @endif

					                @endforeach
							 		 	
							 	</table>
							</div>
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