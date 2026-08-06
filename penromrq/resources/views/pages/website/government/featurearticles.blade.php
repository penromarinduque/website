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
						<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="#"> News & Events </a></li>
						<li class="breadcrumb-item active" aria-current="page"> Featured Article </li>
					</ol>
				</nav>
			</div>

			@for($year = date('Y'); $year >= 2015; $year--)

				<?php 

					$query = app('CenterBarDetails')
								->where('center_id','2')
								->where('status','1')
								->where('published_date','like', '%'.$year.'%')
								->orderBy('created_date','desc')
								->paginate(20,['*'],'feature-article-'.$year);

				?>

				@if(count($query) > 0)
				<div class="col-md-12">
			    <div class="panel panel-defaul">
		        <div class="panel-heading bg-green">
	            <h3 class="panel-title text-white text-center" style="font-size: 12pt;"><b> FEATURED ARTICLES FOR CY {{ $year }}</b></h3>
		        </div>
		        <div class="panel-body">
	            <div class="row"> 
	            	<div class="col-md-12">
		            	<table class="table table-bordered table-condensed">
		            		<tr>
		            			<td class="col-sm-3"></td>
		            			<td class="col-sm-3 text-center"> <label> ARTICLE TITLE </label> </td>
		            			<td class="col-sm-3 text-center"> <label> AUTHOR </label> </td>
		            			<td class="col-sm-3 text-center"> <label> PUBLISHED DATE </label></td>
		            		</tr>
	            			@foreach($query as $key => $value)
			            		<tr>
			            			<td class="col-sm-3 text-center">
			            				<a href="#myModalImage" data-toggle="modal" class="image-load-to-modal" data-image="{{ asset($value->created_image) }}">
				            				<img class="img-thumbnail" src="{{ asset($value->created_image) }}" style="height: 100px;">
				            			</a>
			            			</td>
			            			<td class="col-sm-3 text-center">
			            				<a href="{{ route('website.page',['path' => 'featured-articles', 'action' => 'view-featured-articles', 'id' => Crypt::encrypt($value->detail_id)]) }}" target="_blank" style="text-decoration: none; cursor: pointer;">{{ $value->created_title }}</a> 
			            			</td>
			            			<td class="col-sm-3 text-center"> {{ $value->published_by }} </td>
			            			<td class="col-sm-3 text-center"> {{ date('F d, Y',strtotime($value->published_date)) }} </td>
			            		</tr>
	            			@endforeach
	            			<tr>
	            				<td colspan="4" class="text-center">
	            					{{ $query->links() }}
	            				</td>
	            			</tr>
		            	</table>
		            </div>
	            </div>
		        </div>
			    </div>
				</div>
				@endif
				
			@endfor

			<div id="myModalImage" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body" id="image_load"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@push('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('.image-load-to-modal').on('click',function(){

			var imageLink = $(this).data('image');

			$('#myModalImage #image_load').html('<img src="' + imageLink + '" style="width:100%; height: auto;">');

		});
	});
</script>

@endpush

@endsection
