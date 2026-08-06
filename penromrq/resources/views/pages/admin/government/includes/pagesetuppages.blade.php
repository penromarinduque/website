@foreach($class as $key => $value)

	<li class="@if(request()->exists('tab_'.$value->nav_id)) active @endif">
		<a href="#tab_{{ $value->nav_id }}" @if($value->nav_type == 0) onclick="return setTorequestedUrl('tab_{{ $value->nav_id }}')" data-toggle="tab" @else onclick="return false;" @endif>
		{{ substr($value->nav_name, 0,25) }} 
			@if($value->nav_type == 1) 
				<i class="fa fa-caret-down pull-right"></i> 
			@else 
				<button class="btn btn-default btn-xs btn-flat pull-right" onclick="return confirmDeleteNavmenu('{{ route('website.route',['path' => $path, 'action' => 'admin-delete-users-navmenu' ,'id' => Crypt::encrypt($value->nav_id) ]) }}')" style="margin-top: -2px;">
					<i class="fa fa-trash"></i>
				</button>
			@endif
		</a>
	</li>

	@include('pages.admin.government.includes.pagesetuppages',['class' => $value->nav_sub ])

@endforeach

