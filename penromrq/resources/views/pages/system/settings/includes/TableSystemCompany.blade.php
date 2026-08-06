<div class="row">
	<div class="col-lg-12" style="overflow: auto;">
		<table class="table table-bordered table-condensed" id="users_table">
			<thead>
				<tr style="font-size: 12px; white-space: nowrap;">
					<th class="text-center" style="vertical-align: top; width: 50px;"> ID </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> CODE </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> NAME </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> DESCRIPTION </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> TAGLINE </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> STATUS </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> ACTION </th>
				</tr>
			</thead>
			<tbody id="users_table_body">
				@foreach($allCompany as $key => $value)
					<tr style="font-size: 12px;">
						<td class="text-center">{{ ($key + 1) }}</td>
						<td>{{ $value->company_code }}</td>
						<td>{{ $value->company_name }}</td>
						<td>{{ $value->company_description }}</td>
						<td>{{ $value->company_tagline }}</td>
						<td class="text-center" style="padding-top: 5px; padding-bottom: 0px;"> 
							<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->company_id }}" onclick="return updateStatus(this.id,'{{ route('settings.route',['path' => $path, 'action' => 'settings-toggle-users-company', 'id' => Crypt::encrypt($value->company_id)]) }}')" style="font-size: 22px; cursor: pointer;"></i>
						</td>
						<td class="text-center">
							<a href="{{ route('settings.route',['path' => $path, 'action' => 'edit-company', 'id' => encrypt($value->company_id)]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href="{{ route('settings.route',['path' => $path, 'action' => 'delete-company', 'id' => encrypt($value->company_id)]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@push('scripts')

<script type="text/javascript">

	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(count){
				
			});
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(count){
				
			});
		}
	}
	
</script>

@endpush