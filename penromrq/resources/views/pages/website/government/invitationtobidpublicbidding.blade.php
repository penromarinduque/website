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
		 		    	<li class="breadcrumb-item active" aria-current="page"> Public Bidding </li>
		 		  	</ol>
		 		</nav>
		 	</div>

		 	@foreach(collect($panel)->sortBy("panel_name") as $key => $value)

				<div class="col-md-12">
				    <div class="panel panel-default">
				        <div class="panel-heading bg-green">
				            <h3 class="panel-title text-white text-center" style="font-size: 12pt;"><b> {{ $value->panel_name }} </b></h3>
				        </div>
				        <div class="panel-body">
				            <div class="row"  style="padding: 0rem 1rem;">
				            	<table class="table table-bordered table-condensed">
				            		<tr>
				            			<td class="col-sm-3 text-center"> <label> PUBLISHED DATE AT PENRO MARINDUQUE WEBSITE</label> </td>
				            			<!--<td class="col-sm-3 text-center"> <label> CLOSING DATE/TIME </label> </td>-->
				            			<td class="col-sm-3 text-center"> <label> TITLE </label> </td>
				            			<td class="col-sm-3 text-center"> <label> DOWNLOADABLE DOCUMENTS </label> </td>
				            		</tr>	
				            		
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
					                        		<a href="{{ $details->storage->file_link }}" style="text-decoration: none; color: #000000;" data-toggle="tooltip" title="Click to view">{{ $details->storage->file_name }}</a>
					                        	</td>
					                        	<td class="text-center">
					                        	 	<a href="{{ config('app.admin_url') . $details->storage->file_path }}" onclick="return confirm('Are you sure you want to download this document?')" class="btn btn-info btn-sm"><i class="fa fa-download"></i> BID Documents</a> 	
					                        	</td>
					                        </tr>
					                    @endif

					                @endforeach
					              
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