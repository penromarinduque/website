@foreach($carousel_group_details as $key => $value)
<tr>
	<td style="vertical-align: middle;"> {{ $value->groupInfo->group_code }} </td>
	<td style="vertical-align: middle;"> 
		<a href="#image-modal{{ $value->carousel_id }}" data-toggle="modal"> {{ $value->carousel_text }} </a>
		@include('pages.admin.gender.modal.modalcarouselimage')
	</td>
	<td style="vertical-align: middle;"> {{ $value->carousel_button_text }}</td>
	<td class="text-style" style="vertical-align: middle;"> 
		<a href="#" data-toggle="popover" data-placement="left" data-content="{{ $value->carousel_link }}">{{ $value->carousel_link }}</a>
	</td>
	<td class="text-center" style="min-width: 100px; vertical-align: middle;">
		<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->carousel_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-carousel-group-details', 'id'
		 => Crypt::encrypt($value->carousel_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
	</td>
	<td class="text-center" style="min-width: 100px;">

		<a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-edit-carousel-group-details', 'id' => Crypt::encrypt($value->carousel_id) ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

		<a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-delete-carousel-group-details', 'id' => Crypt::encrypt($value->carousel_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')"class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

	</td>
</tr>
@endforeach

