<div class="row mb-4">
@foreach($PostsDetails as $key => $value)
<div class="col-lg-4">
    <div class="card card-shadow mb-4">
        <img src="{{ asset($value->posts->post_image_path) }}" class="card-img-top" alt="{{ $value->posts->post_subject }}" style="width: 100%; height: 200px;">
        <div class="card-body" style="max-height: ; overflow: ;">
            <div style="overflow: hidden; text-overflow: ellipsis; height: 51px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                <h5 class="card-title text-info" title="{{ $value->posts->post_subject }}"> {{ $value->posts->post_subject }} </h5>
            </div>
            <div style="overflow: hidden; text-overflow: ellipsis; height: 120px; display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; text-align: justify;">
                {!! strip_tags($value->posts->post_content) !!}
            </div>
        </div>
        <div class="card-footer py-2">
            <a href="{{ route('gad.page', ['path' => 'activities', 'action' => 'view-activity-details', 'id' => Crypt::encrypt($value->posts->post_id) ]) }}" class="btn btn-info btn-sm pull-right" target="_blank"> Read More <i class="fa fa-double-caret-right"></i></a>
            <div class="photo-status">
                <div class="photo-status-icon w-100">
                    <small style="font-size: 12px; color:#999; vertical-align: middle;"> POSTED: {{ strtoupper(date('l, F d, Y',strtotime($value->posts->published_date))) }} </small>
                    {{-- <span class="stat-like fa fa-calendar fa-fw"></span> POSTED: MONDAY, OCTOBER 14, 2019 --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>

<div class="row mb-4">
    <div class="col-sm-12">
        {{ 
            $PostsDetails
                ->withPath(route('gad.page',['path' => 'activities', 'action' => 'home-activities', 'id' => '1']))
                ->links('pages.website.gender.includes.activitypagination') 
        }}
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    $(function () {
        $('#activities-pagination').on('click','.page-activity',function(event){
            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                dataType: 'html',
                success: function(data){
                    $('#activities-pagination').html(data);
                }
            });
            return false;
        });
    });
</script>

@endpush
