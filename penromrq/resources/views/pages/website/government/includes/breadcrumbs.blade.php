<div class="col-lg-12">
	<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
  		<li class="breadcrumb-item">
  			<a style="color: green; text-decoration: none;" href="{{ url('/') }}"> Home </a>
  		</li>
    	@foreach($breadcrumbs as $links)
    		<li class="breadcrumb-item">
		 			<a style="color: green; text-decoration: none;" href="{{ $links['anchor_path'] }}"> {{ $links['anchor_name'] }} </a>
		 		</li>
 			@endforeach
  	</ol>
	</nav>
</div>
