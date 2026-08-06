<input type="hidden" name="users_id" value="{{ encrypt($thisUserAccount->users_id) }}">
<table class="table table-bordered table-condensed table-hover" id="users_table">
	<thead>
		<tr style="font-size: 12px; white-space: nowrap;">
			<th class="text-center" style="vertical-align: top; width: 3%"> ID </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> ACTION </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> ROUTE </th>
		</tr>
	</thead>
	<tbody id="users_table_body">
		@foreach($allMethods as $key => $value)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td class="text-center">
				<input type="hidden" name="method[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">
				<input type="hidden" name="method[{{ $key }}][method_id]" value="{{ encrypt($value->method_id) }}">
				<input type="checkbox" class="method-checkbox" name="method[{{ $key }}][checkbox]" style="height: 17px; width: 17px;" {{ (in_array($value->method_id, $methodAccess)) ? 'checked' : '' }}>
			</td>
			<td style="vertical-align: middle;">{{ str_replace('_', ' ', $value->method_function) }}</td>
			<td style="vertical-align: middle;">{{ str_replace('-', ' ', $value->method_name) }}</td>
		</tr>
		@endforeach
		@if(count($allMethods) == 0)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td colspan="3" class="text-center">No result's found.</td>
		</tr>
		@endif
	</tbody>
</table>
