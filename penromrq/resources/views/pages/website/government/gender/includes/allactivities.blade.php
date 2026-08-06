@foreach($PanelDetails as $key => $details)
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset($details->posts->post_image_path) }}" class="card-img" style="height: 150px; width: 100%;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('gad.page', ['path' => 'activities', 'action' => 'view-activity-details', 'id' => Crypt::encrypt($details->posts->detail_id) ]) }}" style="text-decoration: none;" @if($details->posts->post_tab == '1') target="_blank" @endif>{{ $details->posts->post_subject }}</a>
                    </h5>
                    <p class="card-text"> POSTED BY: {{ strtoupper($details->posts->published_by) }} </p>
                    <p class="card-text"><small class="text-muted">{{ strtoupper(date('l, F d, Y',strtotime($details->posts->published_date))) }}</small></p>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="row">
    <div class="col-sm-12">
        {{ $PanelDetails->links('pages.website.gender.includes.activitypagination') }}
    </div>
</div>