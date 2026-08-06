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
						<li class="breadcrumb-item active" aria-current="page">Photo Releases</li>
					</ol>
				</nav>
			</div>

			@for($year = date('Y'); $year >= 2015; $year--)

				<?php 

	    			$query = app('CenterBarVidImg')
	    						->where('center_id','3')
	    						->where('status','1')
	    						->where('published_date','like', '%'.$year.'%')
	    						->orderBy('created_date','desc')
	    						->paginate(20,['*'],'photo-releases-'.$year);

	    		?>

	  			@if(count($query) > 0)

				<div class="col-md-12">
				    <div class="panel panel-defaul">
				        <div class="panel-heading bg-green">
				            <h3 class="panel-title text-white text-center" style="font-size: 12pt;"><b>PHOTO RELEASES FOR CY {{ $year }}</b></h3>
				        </div>
				        <div class="panel-body">
				            <div class="row"> 
				            	<div class="col-md-12">
					            	<table class="table table-bordered table-condensed">
					            		<tr>
					            			<td class="col-sm-6"></td>
					            			<td class="col-sm-6 text-center"> <label> CAPTION </label> </td>
					            		</tr>

				            			@foreach($query as $key => $value )

					            		<tr>
					            			<td class="col-sm-6 text-center">
					            				<a href="#myModalImage" data-toggle="modal" class="image-load-to-modal" data-image="{{ asset($value->vid_img_path) }}" data-title="{{ $value->vid_img_title }}">
					            					<img class="img-thumbnail" src="{{ asset($value->vid_img_path) }}" style="height: 100px;">
					            				</a>
					            			</td>
					            			<td class="col-sm-6 text-center"> 
					            				<a href="{{ $value->vid_img_link }}" style="text-decoration: none;color: #000;"> {{ $value->vid_img_title }} </a> 
					            			</td>
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
						<div class="modal-body text-center" id="image_title"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@push('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('.image-load-to-modal').on('click',function(){

			var imageLink = $(this).data('image');
			var imageTitle = $(this).data('title');

			$('#myModalImage #image_load').html('<img src="' + imageLink + '" style="width:100%; height: auto;">');
			$('#myModalImage #image_title').text(imageTitle);

		});
	});
</script>

@endpush

@include('pages.website.government.includes.agencyfooter')

@include('pages.website.government.includes.standardfooter')

@endsection