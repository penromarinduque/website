<table class="table table-bordered table-condensed" style="font-size: 12px;">
	<thead>
		<tr>
			<th class="text-center" style="width: 20px;"> ORDER </th>
			<th class="text-center"> DESCRIPTION / IMAGE PATH  </th>
			<th class="text-center"> ONCLICK LINK </th>
			<th class="text-center"> STATUS </th>
			<th class="text-center"> ACTION </th>
		</tr>
	</thead>
	<tbody>
		@foreach($value->subClass()->get() as $key => $detail)
			<tr id="footerdetail{{$detail->detail_id}}">
				<td class="text-center" style="vertical-align: middle;"> {{ $detail->order_level }} </td>
				<td style="vertical-align: middle;"> {{ $detail->footer_text }} </td>
				<td style="vertical-align: middle;"> {{ $detail->footer_path }} </td>
				<td class="text-center" style="vertical-align: middle;">
					<i class="{{ ($detail->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $detail->detail_id }}" onclick="return updateStatus(this.id,'{{ route('website.route', ['path' => 'agency-footer' , 'action' => 'admin-toggle-footer-details', 'id' => Crypt::encrypt($detail->detail_id) ]) }}')" style="font-size: 20px; cursor: pointer;"></i>
				</td>
				<td class="text-center" style="vertical-align: middle;">
					<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editfooterdetail{{ $detail->detail_id }}">
						<i class="fa fa-edit"></i>
					</button>
					<button type="button" class="btn btn-danger btn-xs" onclick="return deleteFooterDetail('{{ route('website.route',['path' => 'agency-footer' , 'action' => 'admin-delete-footer-details' , 'id' => Crypt::encrypt($detail->detail_id) ]) }}')">
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

