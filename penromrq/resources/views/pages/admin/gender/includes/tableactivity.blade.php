<table class="table table-bordered table-hover">
    <thead class="bg-info">
        <tr>
            <th class="text-center"> ID </th>
            <th class="text-center col-sm-3"> PUBLISHED DATE </th>
            <th class="text-center col-sm-3"> DESCRIPTION </th>
            <th class="text-center col-sm-3"> STATUS </th>
            <th class="text-center col-sm-3"> ACTION </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $webdata->gender_retrieve_all_panel_details($GenderPanel->panel_id) as $key => $value)
        <tr>
            <td class="text-center" style="vertical-align: middle;"><b>{{ ($key + 1) }}</b></td>
            <td class="text-center" style="vertical-align: middle;">
                {{ date('Y-m-d',strtotime($value->posts->published_date)) }}
            </td>
            <td>{{ $value->posts->post_subject }}</td>
            <td class="text-center" style="vertical-align: middle;">
                <i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-activity', 'id'
                => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-edit-activity','id' => Crypt::encrypt($value->detail_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-delete-activity','id' => Crypt::encrypt($value->detail_id)]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this row?')"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>{{ $webdata->gender_retrieve_all_panel_details($GenderPanel->panel_id)->links('pages.admin.gender.includes.genderpagination') }}</td>
        </tr>
    </tbody>
</table>