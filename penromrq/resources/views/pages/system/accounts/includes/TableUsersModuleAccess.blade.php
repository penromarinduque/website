<input type="hidden" name="users_id" value="{{ encrypt($thisUserAccount->users_id) }}">
<table class="table table-bordered table-condensed table-hover" id="users_table">
	<thead>
		<tr style="font-size: 12px;">
			<th class="text-center" style="vertical-align: top; width: 03%"> </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> MODULE CODE </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> MODULE DESCRIPTION </th>
		</tr>
	</thead>
	<tbody id="users_table_body">
		@foreach($companyModule as $key => $value)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td class="text-center no-padding" style="vertical-align: middle;">
				<input type="hidden" name="module[{{ $key }}][company_id]" value="{{ encrypt($companyId) }}">
				<input type="hidden" name="module[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">
				<input type="hidden" name="module[{{ $key }}][module_id]" value="{{ encrypt($value->module_id) }}">
				<input type="checkbox" class="method-checkbox" name="module[{{ $key }}][checkbox]" {{ (in_array($value->module_id, $moduleAccess)) ? 'checked' : '' }} style="width: 16px; height: 16px;">
			</td>
			<td style="text-transform: uppercase; vertical-align: middle;"> {{ $value->module_code }} </td>
			<td style="vertical-align: middle;"> {{ $value->module_description }} </td>
		</tr>
		@endforeach
		@if(count($companyModule) == 0)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td colspan="3" class="text-center">No result's found.</td>
		</tr>
		@endif
	</tbody>
</table>
