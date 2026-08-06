<table class="table table-bordered table-hover">
    <thead>
        <tr class="bg-info">
            <th class="text-center">ID</th>
            <th class="text-center">DESCRIPTION</th>
            <th class="text-center">URL PATH</th>
            <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($navdetails as $key => $value)
            <tr>
                <td><b>{{ ($key + 1) }}</b></td>
                <td><b>{{ $value->detail_name }}</b></td>
                <td>{{ $value->detail_link }}</td>
                <td class="text-center">
                    <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-retrieve-panel','id' => encrypt($value->detail_id)]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> PANEL </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>