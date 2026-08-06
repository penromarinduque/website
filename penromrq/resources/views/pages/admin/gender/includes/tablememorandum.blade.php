<table class="table table-bordered table-hover">
    <thead class="bg-info">
        <tr>
            <th class="text-center" style="min-width: 10px;"> ID </th>
            <th class="text-center"> GROUP </th>
            <th class="text-center"> NUMBER </th>
            <th class="text-center" style="width: 35%;"> TITLE </th>
            <th class="text-center" style="min-width: 100px;"> TAB </th>
            <th class="text-center" style="min-width: 100px;"> STATUS </th>
            <th class="text-center" style="min-width: 100px;"> ACTION </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $webdata->gender_retrieve_all_panel_details($GenderPanel->panel_id) as $key => $value)
        <tr>
            <td class="text-center" style="vertical-align: middle;"><b>{{ ($key + 1) }}</b></td>
            <td class="text-center" style="vertical-align: middle;">
                <span data-toggle="tooltip" data-title="{{ $value->links->panelInfo->panel_name }}">{{ str_limit($value->links->panelInfo->panel_name,15) }}</span>
            </td>
            <td style="vertical-align: middle;">{{ $value->links->link_code }}</td>
            <td style="vertical-align: middle; text-align: center;">
                <span data-toggle="tooltip" data-title="{{ $value->links->link_description }}">{{ str_limit($value->links->link_description,50) }}</span>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <i class="{{ ($value->links->link_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggletab{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-memorandum-tab', 'id'
                => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-memorandum', 'id'
                => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-edit-memorandum','id' => Crypt::encrypt($value->detail_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-delete-memorandum','id' => Crypt::encrypt($value->detail_id)]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this row?')"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">
                {{ $webdata->gender_retrieve_all_panel_details($GenderPanel->panel_id)->links('pages.admin.gender.includes.genderpagination') }}
            </td>
        </tr>
    </tbody>
</table>