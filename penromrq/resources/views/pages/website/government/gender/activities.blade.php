@extends('pages.website.gender.layouts.layout')

@section('content')

<section class="bg-light py-5">
    <div class="container">
    	<nav aria-label="breadcrumb">
    		<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="/">Home</a></li>
    			<li class="breadcrumb-item"><a href="/gad/activities">Activities</a></li>
    			<li class="breadcrumb-item active" aria-current="page">GAD Related Activities</li>
    		</ol>
    	</nav>
        <div class="row">
            <div class="col-lg-12 mx-auto d-none">
                <h2 class="text-center" style="color: #4f31a3; font-weight: bold;"> GAD RELATED ACTIVITIES </h2>
                <p class="lead" style="display: none;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
            </div>
            <div class="col-lg-12 h-100">

                @foreach($Panels as $key => $panel)
            	
					<div class="card">
						<div class="card-header text-center" style="background-color: #4f31a3 !important">
							<b class="text-white"> GAD ACTIVITIES CY {{ $panel->panel_name }} </b>
						</div>
						<div class="card-body">
							<div id="all-activities-pagination">
                                
                                @foreach($panel->panel_details as $key => $details)
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
                                        {{ $panel->panel_details->links('pages.website.gender.includes.activitypagination') }}
                                    </div>
                                </div>

							</div>
						</div>
					</div>

                @endforeach

           	</div>
        </div>
    </div>
</section>

@endsection

@push('scripts')

<script type="text/javascript">
    $(function () {
        $('#all-activities-pagination').on('click','.page-activity',function(event){
            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                dataType: 'html',
                success: function(data){
                    $('#all-activities-pagination').html(data);
                }
            });
            return false;
        });
    });
</script>

@endpush