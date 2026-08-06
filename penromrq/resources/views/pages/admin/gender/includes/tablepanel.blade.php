<table class="table table-bordered table-hover">
    <thead>
        <tr class="bg-info">
            <th class="text-center" style="width: 5%;"> ID </th>
            <th class="text-center" style="width: 75%"> DESCRIPTION </th>
            <th class="text-center" style="width: 20%;"> ACTION </th>
        </tr>
    </thead>
    <tbody>
        @foreach($GenderPanel as $key => $value)
        <tr>
            <td class="text-center" style="vertical-align: middle;"><b>{{ ($key + 1) }}</b></td>
            <td style="vertical-align: middle;"><b>{{ $value->panel_name }}</b></td>
            <td class="text-center">
                <a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-retrieve-panel-details','id' => Crypt::encrypt($value->panel_id)]) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Manage Content"><i class="fa fa-cog"></i></a>
                <a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-edit-panel','id' => Crypt::encrypt($value->panel_id)]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Update Panel"><i class="fa fa-edit"></i></a>
                <a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-delete-panel','id' => Crypt::encrypt($value->panel_id)]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete Panel" onclick="confirm('Are you sure you want to delete this row?')"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @if(count($GenderPanel) == 0)
        <tr>
            <td class="text-center" colspan="3">
                <label> No result's found! Try to add new panel. </label>
            </td>
        </tr>
        @endif
    </tbody>
</table> 