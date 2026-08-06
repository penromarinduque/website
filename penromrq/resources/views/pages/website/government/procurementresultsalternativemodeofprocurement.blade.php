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
		 		    	<li class="breadcrumb-item active" aria-current="page"> Alternative Mode of Procurement </li>
		 		  	</ol>
		 		</nav>
		 	</div>

		 	@foreach($panel as $key => $value)
		 	{{-- {{ $key }} --}}
			<div class="col-md-12">
			    <div class="panel panel-default">
			        <div class="panel-heading bg-green">
			            <h3 class="panel-title text-white text-center" style="font-size: 12pt;"><b> {{ $value->panel_name }} </b></h3>
			        </div>
			        <div class="panel-body">
			            <div class="row" style="padding: 0rem 1rem;">
			            	<table class="table table-bordered table-condensed">
			            		<tr>
			            			<td class="col-sm-3 text-center"> <label> PUBLISHED DATE AT PENRO MARINDUQUE WEBSITE</label> </td>
			            			<!--<td class="col-sm-3 text-center"> <label> CLOSING DATE/TIME </label> </td>-->
			            			<td class="col-sm-3 text-center"> <label> TITLE </label> </td>
			            			<td class="col-sm-3 text-center"> <label> RESULT </label> </td>
			            		</tr>	

			            		@if(!empty($value))
					                @foreach($value->details as $key => $details)

					                    @if($details->panel_dtl_type == '1')
					                        <tr>
					                        	<td class="text-center"  style="vertical-align: middle;">
					                        		{{ date('m/d/Y',strtotime($details->storage->created_date)) }}
					                        	</td>
					                        	<!--<td class="text-center" style="vertical-align: middle;">-->
					                        	<!--	{{ date('Y/m/d h:i A',strtotime($details->storage->closing_date)) }}-->
					                        	<!--</td>-->
					                        	<td style="vertical-align: middle;">
					                        		{{ $details->storage->file_name }}
					                        	</td>
					                        	<td class="text-center">
					                        	 	<a href="{{ $details->storage->file_link }}" style="text-decoration: none; color: #000000;" data-toggle="tooltip" title="Click to view">{{ $details->storage->bid_result }}</a>
					                        	</td>
					                        </tr>
					                    @endif

					                @endforeach
				                @endif
						 		 	
						 	 </table>
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