@foreach($class as $key => $value)
    <ul>
        <li> 
        	<span> <strong>{{ $value->nav_name }}</strong> | {{ $value->nav_path }} | {{ $value->nav_blade }} </span>
          	@include('pages.admin.government.navigationcleanview', ['class' => $value->nav_sub ])
        </li>
    </ul>
@endforeach