<div class="row">
    <div class="col-md-12">
        <form method="get" action="{{ route('website.route',['path' => $path, 'action' => $action ,'id' => Crypt::encrypt($center->center_id)]) }}">
            <label for="headline_title"> DESCRIPTION </label>
            <span class="pull-right" style="margin-bottom: 10px;">
                <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-plus fa-fw"></i> CREATE </button>
            </span>
            <textarea type="text" class="form-control" name="headline_title" id="headline_title" autocomplete="off" style="resize: vertical;" placeholder="Place some text here."></textarea>
            <input type="hidden" name="previous" value="{{ $center->center_panel_code }}">
        </form>
    </div>
    <div class="col-md-12">
        <div style="overflow: auto;">
            <table class="table table-hover table-bordered" id="news_datatable">
                <thead>
                    <tr class="font-12">
                        <th class="text-center" style="width: 9vw;"> IMAGE/VIDEO </th>
                        <th class="text-center" style="width: 20%;"> DATE </th>
                        <th class="text-center" style="width: 20%;"> TYPE </th>
                        <th class="text-center" style="width: 25%;"> DESCRIPTION </th>
                        <th class="text-center" style="width: 25%;"> STATUS </th>
                        <th class="text-center" style="min-width: 120px;"> ACTION </th>
                    </tr>
                </thead>
                <tbody class="font-12">
                    @foreach($center->subClassVidImg()->paginate(10,['*'], $center->center_panel_code.'-page') as $keys => $detail)
                    <tr>
                        <td class="no-padding text-center" style="vertical-align: middle;">

                            <a href="@if($detail->vid_img_flag == 'V') #showVideoModal{{ $detail->content_id }} @else #showImageModal{{ $detail->content_id }} @endif" data-toggle="modal">
                                <img src="{{ asset($detail->vid_img_path) }}" style="height: 7vh; width: 7vw">
                            </a>

                            @if($detail->vid_img_flag == 'V')

                            @include('pages.admin.government.modal.modalshowvideo', ['playvideo' => $detail->vid_img_embed, 'id' => $detail->content_id])

                            @else

                            @include('pages.admin.government.modal.modalshowimage', ['image_path' => $detail->vid_img_path, 'id' => $detail->content_id])
                            
                            @endif

                        </td>
                        <td style="vertical-align: middle; text-align: center;">{{ $detail->published_date }}</td>
                        <td style="vertical-align: middle; text-align: center;">{{ ($detail->vid_img_flag == 'I') ? 'IMAGE' : 'VIDEO' }}</td>
                        <td style="vertical-align: middle;">{{ $detail->vid_img_title }}</td>
                        <td style="vertical-align: middle; text-align: center;">
                            <i class="{{ ($detail->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $detail->content_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-center-panel-image-video', 'id'
                            => Crypt::encrypt($detail->content_id) ]) }}')" style="font-size: 20px; cursor: pointer;"></i>
                        </td>
                        <td class="text-center" style="vertical-align: middle; ">
                            <a href="{{ route('website.route',['path' => $path, 'action' => 'admin-view-edit-center-panel-image-video', 'id' => Crypt::encrypt($detail->content_id) ])  }}?previous={{ $center->center_panel_code }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> </a>
                            <a href="{{ route('website.route',['path' => $path, 'action' => 'admin-delete-center-panel-image-video', 'id' => Crypt::encrypt($detail->content_id)]) }}" onclick="return confirm('Are you sure you want to delete this row?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-center">
            {{ $center->subClassVidImg()->paginate(10,['*'], $center->center_panel_code.'-page')->appends([ $center->center_panel_code => ''])->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>