@foreach( $GenderNavBarDetails as $key => $value)

<tr>
    <td style="vertical-align: middle;"> {{ $value->detail_level }} </td>
    <td style="vertical-align: middle;"> {{ $value->navBarInfo->nav_description }} </td>
    <td style="vertical-align: middle;"> {{ $value->detail_name }} </td>
    <td style="vertical-align: middle;"> {{ $value->detail_path }}</td>
    <td style="vertical-align: middle;"> {{ str_replace('pages.website.gender.', '', $value->detail_blade) }}</td>
    <td style="vertical-align: middle;"> {{ $value->detail_link }}</td>
    <td class="text-center" style="vertical-align: middle;"> 
        <i class="{{ ($value->detail_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatusTab{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-navigation-group-details-tab', 'id'
         => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;" data-toggle="tooltip" title="Open in new tab"></i>
    </td>
    <td class="text-center" style="vertical-align: middle;"> 
        <i class="{{ ($value->detail_type == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatusType{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-navigation-group-details-type', 'id'
         => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;" data-toggle="tooltip" title="With Dropdown"></i>
    </td>
    <td class="text-center" style="min-width: 100px; vertical-align: middle;">
        <i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->detail_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-navigation-group-details', 'id'
         => Crypt::encrypt($value->detail_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
    </td>
    <td class="text-center" style="min-width: 100px;">

        <a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-edit-navigation-group-details', 'id' => Crypt::encrypt($value->detail_id) ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-delete-navigation-group-details', 'id' => Crypt::encrypt($value->detail_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')"class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

    </td>
</tr>

<?php 

    $GenderNavBarDetailsSub = app('GenderNavBarDetails')
                                ->where('detail_parent', $value->detail_id)
                                ->orderBy('order_level','desc')->get();

?>

@include('pages.admin.gender.includes.navigationgroupdetailstable', ['GenderNavBarDetails' => $GenderNavBarDetailsSub])

@endforeach