@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')

<style type="text/css">

    .background-image
    {
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 30vh;
        width: 100%;
    }

    .box-shadow{
        box-shadow: 1px 2px 5px 2px #999;
    }

    .border-light{
        box-shadow: 0.9px 1px 3px 3px #f7f5f5;
    }

    .padding-t20
    {
        padding-top: 20px; 
    }

    .padding-b20
    {
        padding-bottom: 20px; 
    }

    .box-shadow-btm
    {
        box-shadow: 0 4px 10px -2px #e6e6e6 !important;
    }

    .margin-t50
    {
        margin-top: 50px;
    }

</style>

<section class="content-header">
    <h1> Dashboard <small>Control panel</small> </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}">
                <i class="fa fa-dashboard"></i> Dashboard 
            </a>
        </li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            @include('errors.alerts')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="alert alert-info alert-dismissible">
                <b> <i class="icon fa fa-calendar"></i> WEBSITE ADMIN {{ date('Y') }} </b>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $cnt_news_and_events }}</h3>
                    <p> News and Events </p>
                </div>
                <div class="icon">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <a href="/{{ $activeModule->module_prefix }}/center-panel?events" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $cnt_feature_article }}</h3>
                    <p>Featured Articles</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="/{{ $activeModule->module_prefix }}/center-panel?articles" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $cnt_feature_photo }}</h3>
                    <p>Photo Releases</p>
                </div>
                <div class="icon">
                    <i class="fa fa-photo"></i>
                </div>
                <a href="/{{ $activeModule->module_prefix }}/center-panel?photos" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $cnt_feature_video }}</h3>
                    <p>Featured Videos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-youtube-play"></i>
                </div>
                <a href="/{{ $activeModule->module_prefix }}/center-panel?videos" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border" style="padding: 20px 10px 20px; box-shadow: 0 4px 5px -2px #f7f5f5;">
                    <h3 class="box-title">
                        <i class="fa fa-list fa-fw"></i> Home
                    </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="nav-tabs-custom"> 
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#viewnewsandevents" data-toggle="tab">
                                                <b> <i class="fa fa-plus"></i> News and Events </b>
                                            </a>
                                        </li>
                                        <li><a href="#viewfeaturedarticles" data-toggle="tab"><b> <i class="fa fa-plus"></i> Featured Articles </b></a></li>
                                        <li><a href="#viewphotoreleases" data-toggle="tab"><b> <i class="fa fa-plus"></i> Photo Releases </b></a></li>
                                        <li><a href="#viewfeaturedvideos" data-toggle="tab"><b> <i class="fa fa-plus"></i> Featured Videos </b></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade in" id="viewnewsandevents"> 
                                            @include('pages.admin.government.forms.formaddnewsandarticles',[ 'center' => [ 'center_id' => '1' ] ])
                                        </div>
                                        <div class="tab-pane fade " id="viewfeaturedarticles"> 
                                            @include('pages.admin.government.forms.formaddnewsandarticles',[ 'center' => [ 'center_id' => '2' ] ])
                                        </div>
                                        <div class="tab-pane fade " id="viewphotoreleases"> 
                                            @include('pages.admin.government.forms.formaddimageandvideos', [ 'center' => [ 'center_id' => '3' ],'image' => true ])
                                        </div>
                                        <div class="tab-pane fade " id="viewfeaturedvideos"> 
                                            @include('pages.admin.government.forms.formaddimageandvideos', [ 'center' => [ 'center_id' => '4' ],'video' => true ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('pages.admin.government.modal.modaladdimages')

@push('scripts')

@include('pages.admin.government.customscript')

<script type="text/javascript">
    
    $(document).ready(function(){
        $('.check_flag_img_vid').on('click',function(){
            if($(this).prop("checked") == true)
            {
                $('.image-type').css('display','block');
                $('.video-type').css('display','none');
            }else{
                $('.video-type').css('display','block');
                $('.image-type').css('display','none');
            }
        });
    });

    function checkVideoImageType(value) {
        if(value == 'I') {
            $('.image-type').css('display','block');
            $('.video-type').css('display','none');
            $('#created_image').attr('required',true);
        } else {
            $('.video-type').css('display','block');
            $('.image-type').css('display','none');
            $('#created_image').attr('required',false);
        }
    }

    function showModalAddImage() {
        $('#modaladdnewimage').modal('show');
        $.ajax({
            url: "{{ route('website.route',['path' => $path, 'action' => 'website-retrieve-storage-images', 'id' => encrypt('')])}}",
            type: 'get',
            dataType:'html',
            success: function(data){
                $('#modaladdnewimage #data_uploaded_image').html(data);
            }
        });
    }

</script>

@endpush

@endsection

