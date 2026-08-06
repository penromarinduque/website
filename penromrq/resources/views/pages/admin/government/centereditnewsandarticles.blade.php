@extends('layouts.layout')

@section('title', 'News & Articles Content')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('web/bootstrap/css/customstyle.css') }}">
@endsection

@section('content')

<section class="content-header">
    <h1><i class="fa fa-edit fa-fw"></i> News & Articles Content <small> Control panel </small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ $activeModule->module_prefix }}/home"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{{ route('website.route',['path' => $path]) }}"><i class="fa fa-box"></i> Center Panel </a> </li>
        <li class="active"> <i class="fa fa-box"></i> Edit Center Panel </li>
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
                            @include('pages.admin.government.forms.formeditnewsandevents',['center' => $center])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.admin.government.modal.modaladdimages')
    
</div>
@endsection

@section('scripts')

@include('pages.admin.government.customscript')

<script type="text/javascript">

    function updateStatus(id,url){
        if($('#'+id).hasClass('fa-toggle-on')){
            $('#'+id).removeClass('fa-toggle-on')
            .removeClass('text-orange')
            .addClass('fa-toggle-off').addClass('text-red');
            tooglestatus(url,0);
        } else if($('#'+id).hasClass('fa-toggle-off')){
            $('#'+id).removeClass('fa-toggle-off')
            .removeClass('text-red')
            .addClass('fa-toggle-on').addClass('text-orange');
            tooglestatus(url,1);
        }
    }

    function ValidateFileUpload(evt) {
        var fuData = document.getElementById(evt);
        var FileUploadPath = fuData.value;

        if (FileUploadPath == '') {
            alert("Please upload an image");
        } else {
            var Extension = FileUploadPath.substring(
                            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // $('#display_image1').css('background-image', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } else {
                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
            }
        }
    }

</script>

@endsection