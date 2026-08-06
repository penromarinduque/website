<table class="table table-bordered table-hover">
    <thead class="bg-info">
        <tr>
            <th class="text-center" style="min-width: 10px;"> ID </th>
            <th class="text-center"> GROUP </th>
            <th class="text-center"> DESCRIPTION </th>
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
                {{ $value->files->panelInfo->panel_name }}
            </td>
            <td style="vertical-align: middle;">
                @php 
                    $Imagepath = Storage::disk('gender')->url($value->files->file_path);
                    $Imagelink = $value->files->file_link;
                @endphp
                <a href="#modalphotoreleases" onclick="openPhotoReleaseModal('{{ $Imagepath }}','{{ $Imagelink }}')">{{ $value->files->file_name }}</a>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <i class="{{ ($value->files->file_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="toggletab{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-photo-releases-tab', 'id'
                => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-photo-releases', 'id'
                => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
            </td>
            <td class="text-center" style="vertical-align: middle;">
                <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-edit-photo-releases','id' => Crypt::encrypt($value->detail_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-delete-photo-releases','id' => Crypt::encrypt($value->detail_id)]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this row?')"><i class="fa fa-trash"></i></a>
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