<ul>
	@foreach($details as $key => $value)
  		<li><a href="{{ $value->footer_path }}" target="_blank">{{ $value->footer_text }}</a></li>
	@endforeach
</ul>