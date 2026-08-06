@extends('layouts.layout')

@section('title', 'Center Panel Form')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('web/bootstrap/css/customstyle.css') }}">
@endsection

@section('content')

<section class="content-header">
	<h1>
		<i class="fa fa-box"></i> Center Panel Form
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/home"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-box"></i> Center Panel Form </li>
	</ol>
</section>

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

<div class="content">

    @include('errors.alerts')

    <div class="box box-primary">

        <div class="box-header with-border" style="padding: 20px 10px 20px; box-shadow: 0 4px 5px -2px #f7f5f5;">
            <h3 class="box-title">
                <a href="{{ route('website.route',['path' => $path]) }}?{{ request()->previous }}" data-toggle="tooltip" data-placement="right" title="Back to table"><i class="fa fa-arrow-left fa-fw"></i> Back </a>
            </h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @include('pages.admin.government.forms.formaddnewsandarticles',['center' => $center])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
