@extends('pages.website.gender.layouts.layout')

@section('content')

<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h2 class="text-center" style="color: #4f31a3; font-weight: bold;"> {{ $detail->detail_title }} </h2>
                <p class="lead" style="display: none;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
            </div>
            <div class="col-lg-12 mx-auto">
                <div class="card card-shadow mb-4">
                    <img src="{{ asset($detail->detail_image_path) }}" class="card-img-top" alt="{{ $detail->detail_title }}" style="width: 100%; height: 430px;">
                    <div class="card-body">
                        {!! $detail->detail_html_code !!}
                    </div>
                    <div class="card-footer py-2">
                        <div class="photo-status">
                            <div class="photo-status-icon w-100">
                                <small style="font-size: 12px; color:#999; vertical-align: middle;"> POSTED: {{ strtoupper(date('l, F d, Y',strtotime($detail->published_date))) }} {{ strtoupper($detail->published_by) }} </small>
                                {{-- <span class="stat-like fa fa-calendar fa-fw"></span> POSTED: MONDAY, OCTOBER 14, 2019 --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection