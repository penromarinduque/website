@foreach($class as $key => $subclass)

	<?php 
		if($subclass->nav_parent == '0'){
			$menuclass = 'dropdown';
		}
		else if($subclass->nav_type == '1' && count($subclass->nav_sub) > 0)
		{
			$menuclass = 'dropdown-submenu';
		}else{
			$menuclass = 'dropdown';
		}
	?>

	<li class="{{ $menuclass }}">
		<a @if($subclass->nav_type == '1') class="dropdown-toggle submenu" data-toggle="dropdown" @endif id="{{ $subclass->nav_id }}" href="{{ $subclass->nav_href }}" @if($subclass->nav_tab == '1') target="_blank" @endif>
			{{ $subclass->nav_name }} @if($subclass->nav_type == '1') <span class="pull-right fa fa-caret-down fa-fw"></span> @endif
		</a>
		{{-- IF MENU HAS DROPDOWN --}}
		@if($subclass->nav_type == '1')
			<ul class="dropdown-menu" id="menu{{ $subclass->nav_id }}">
				@include('pages.website.government.includes.includenavdetails', ['class' => $subclass->nav_sub])
	   	</ul>
		@endif
	</li>
@endforeach

