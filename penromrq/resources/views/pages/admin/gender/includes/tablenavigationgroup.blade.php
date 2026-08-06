
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="text-center"> GROUP </th>
			<th class="text-center"> DESCRIPTION </th>
			<th class="text-center"> STATUS </th>
			<th class="text-center"> ACTION </th>
		</tr>
	</thead>
	<tbody>
		@foreach( app('GenderNavBar')->orderBy('order_level','desc')->get() as $key => $value)
		<tr>
			<td style="vertical-align: middle;">
				<a href="#modalnavigationimage{{ $value->nav_id }}" data-toggle="modal" title="Click to view image">{{ $value->nav_logo_text }}</a>
				@include('pages.admin.gender.modal.modalnavigationimage')
			</td>
			<td style="vertical-align: middle;"> {{ $value->nav_description }} </td>
			<td class="text-center" style="min-width: 100px; vertical-align: middle;">
				<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->nav_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-navigation-group', 'id'
				=> Crypt::encrypt($value->nav_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
			</td>
			<td class="text-center" style="min-width: 100px;">
				<a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-edit-navigation-group', 'id' => Crypt::encrypt($value->nav_id) ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
				<a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-delete-navigation-group', 'id' => Crypt::encrypt($value->nav_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')"class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
