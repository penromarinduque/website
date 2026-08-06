<input type="hidden" name="users_id" value="{{ encrypt($thisUserAccount->users_id) }}">
<table class="table table-bordered table-condensed table-hover" id="users_table">
	<thead>
		<tr style="font-size: 12px; white-space: nowrap;">
			<th class="text-center" style="vertical-align: top; width: 3%">  ID </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> COMPANY CODE </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> COMPANY NAME </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> COMPANY DESCRIPTION </th>
		</tr>
	</thead>
	<tbody>
		@foreach($systemCompany as $key => $value)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td class="text-center">
				<input type="hidden" name="company[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">
				<input type="hidden" name="company[{{ $key }}][company_id]" value="{{ encrypt($value->company_id) }}">
				<input type="checkbox" class="method-checkbox" name="company[{{ $key }}][checkbox]" {{ (in_array($value->company_id, $usersCompany)) ? 'checked' : '' }} style="height: 16px; width: 16px;" @if($thisUserAccount->company_id == $value->company_id) onclick="return false" @endif>
			</td>
			<td style="vertical-align: middle;"> 
				{{ $value->company_code }} 
				@if($thisUserAccount->company_id == $value->company_id) (YOUR COMPANY) @endif
			</td>
			<td style="vertical-align: middle;"> {{ $value->company_name }} </td>
			<td style="vertical-align: middle;"> {{ $value->company_description }} </td>
		</tr>
		@endforeach
		@if(count($systemCompany) == 0)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td colspan="4" class="text-center">No result's found.</td>
		</tr>
		@endif
	</tbody>
</table>
