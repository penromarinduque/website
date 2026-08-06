    <div class="row">

        <div class="col-md-12">
            <form method="get" action="{{ route('website.route',['path' => $path, 'action' => $action ,'id' => Crypt::encrypt($center->center_id)]) }}">
                <div class="">
                    <label for="headline_title">HEADLINE / TITLE</label>
                    <span class="pull-right">
                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-plus fa-fw"></i> CREATE </button>
                    </span>
                    <textarea type="text" class="form-control" name="headline_title" id="headline_title" autocomplete="off" style="resize: vertical;" placeholder="Place some text here."></textarea>
                    <input type="hidden" name="previous" value="{{ $center->center_panel_code }}">
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <hr>
            <div class="border-light" style="overflow: auto;">
                <table class="table table-bordered table-striped table-hover" id="news_datatable">
                    <thead>
                        <tr class="font-12 nowrap">
                            <th class="text-center"> HEADLINE/TITLE </th>
                            <th class="text-center" style="width: 150px;"> PUBLISHED DATE </th>
                            <th class="text-center"> PUBLISHED BY </th>
                            <th class="text-center" style="width: 100px;"> STATUS </th>
                            <th class="text-center" style="width: 150px;"> ACTION </th>
                        </tr>
                    </thead>
                    <tbody class="font-12">
                        @foreach($center->subClass()->paginate(10,['*'], $center->center_panel_code.'-page') as $keys => $detail)
                        <tr>
                            <td>{{ substr($detail->created_title,0,50) }}</td>
                            <td style="white-space: nowrap;">{{ $detail->published_date }}</td>
                            <td>{{ substr($detail->published_by,0,50) }}</td>
                            <td class="text-center"> 
                                <i class="{{ ($detail->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $detail->detail_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-center-panel-details', 'id'
                                 => Crypt::encrypt($detail->detail_id) ]) }}')" style="font-size: 20px; cursor: pointer;"></i>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('website.route',['path' => $path, 'action' => 'admin-view-edit-news-and-articles', 'id'
                                 => Crypt::encrypt($detail->detail_id) ]) }}?previous={{ $center->center_panel_code }}" class="btn btn-primary btn-xs"> 
                                    <i class="fa fa-edit fa-fw"></i> </a>

                                <a href="{{ route('website.route',['path' => $path, 'action' => 'admin-delete-news-and-articles', 'id'
                                 => Crypt::encrypt($detail->detail_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')" class="btn btn-danger btn-xs"> 
                                    <i class="fa fa-trash fa-fw"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 pull-right">
            {{ $center->subClass()->paginate(10,['*'], $center->center_panel_code.'-page')->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
