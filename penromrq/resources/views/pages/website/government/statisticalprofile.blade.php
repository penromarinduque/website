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
						<li class="breadcrumb-item active"> ENR Statistical Profile </li>
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
			        	<?php
		            	// print_r($value->details);
	                	$collected = [];
	                    foreach ($value->details as $key => $detail) {
	                        $collected[] = $detail;
	                    }
	                    $collection = collect($collected); // collect stored objects
	                    $results = $collection->sortByDesc('order_level'); // sort by order_level DESC
	                    // print_r($results);
	                	?>
	                	@forelse($results as $details)
                			@if($details->panel_dtl_type == '3')
                                <div class="col-md-12" style="text-align: justify; text-justify: inter-word; margin-bottom: 10px;">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="text-center" style="margin-bottom: 10px; color: green;">
                                                <h3>{{ $details->longtext->long_description }}</h3>
                                            </div>
                                            <div class="long-text-body">
                                                {!! $details->longtext->long_text !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
	                    @empty
			            @endforelse

			            <div class="row">
                    		{{--@foreach($value->details as $key => $details)--}}
                    		@forelse($results as $details)
                    			

			                    @if($details->panel_dtl_type == '1')

			                    	<div class="col-md-4">
		                        		<a href="{{ $details->storage->file_link }}" target="_blank">
		                        			<img src="{{ asset($details->storage->file_path) }}" style="width: 100%; height: auto; min-width: 200px; min-height: 250px;">
		                        		</a>
			                        </div>
			                    @endif

			                    
			                @empty
			                @endforelse
			                {{--@endforeach--}}
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