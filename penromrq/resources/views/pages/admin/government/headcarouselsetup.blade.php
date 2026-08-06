@extends('layouts.layout')

@section('title', 'Head Carousel Setup')

@section('content')

<section class="content-header">
    <h1> &nbsp; </h1>
    <ol class="breadcrumb">
        <li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active"> <i class="fa fa-box"></i> Head Carousel Setup </li>
    </ol>
</section>
<div class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: white;">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-bars fa-fw"></span>
                        <label> HEAD CAROUSEL SETUP </label> 
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab"><b> <i class="fa fa-table"></i> TABLE </b></a></li>
                            <li><a href="#tab_2" data-toggle="tab"><b> <i class="fa fa-table"></i> TILE </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content" style="min-height: 72vh">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-header text-right" style="margin-bottom: 20px;">
                                    <form method="post" action="{{ route('website.route',['path' => $path ,'action' => 'admin-search-carousel', 'id' => encrypt(1)]) }}">
                                        {{ csrf_field() }}
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-right" style="width: 15%; font-size: 9pt; padding: 8px 10px 0px 0px;"><b> SEARCH BY: </b></th>
                                                <td class="no-padding"> 
                                                    <input type="text" class="form-control input-sm" name="filter_carousel_search" maxlength="20" value="{{ request()->filter_carousel_search }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="width: 15%; font-size: 9pt; padding: 8px 10px 0px 0px;"><b> GROUP BY: </b></td>
                                                <td class="no-padding">
                                                    <div class="input-group"> 
                                                        <select class="form-control input-sm" name="filter_carousel_group">
                                                            <option value=""> --Select-- </option>
                                                            @foreach($carouselGroup as $group)
                                                            <option value="{{ $group->group_id }}" @if(request()->filter_carousel_group == $group->group_id ) selected @endif> 
                                                                {{ $group->group_code }} - {{ $group->group_name }} 
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-sm" data-target="#modaladdcarouselgroup" data-toggle="modal" title="ADD GROUP">
                                                                <i class="fa fa-plus"></i> GROUP
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-right" style="width: 15%; font-size: 9pt; padding: 8px 10px 0px 0px;"><b> STATUS: </b></th>
                                                <td class="no-padding"> 
                                                    <select class="form-control input-sm" name="filter_carousel_status">
                                                        <option value=""> --Select-- </option>
                                                        <option value="1" @if(request()->filter_carousel_status == '1') selected @endif> Active </option>
                                                        <option value="0" @if(request()->filter_carousel_status == '0') selected @endif> Inactive </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="padding:10px 0px 10px 10px;">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fa fa-search"></i> SEARCH 
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addcarousel">
                                                        <i class="fa fa-plus"></i> CREATE
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab_1">
                            <table class="table table-bordered table-condensed table-striped">
                                <thead>
                                    <tr style="font-size: 9pt;">
                                        <th class="text-center" style="width: 10%; min-width: 100px;"> GROUP </th>
                                        <th class="text-center" style="width: 10%; min-width: 100px;"> IMAGE </th>
                                        <th class="text-center" style="width: 20%; min-width: 100px;"> DESCRIPTION </th>
                                        <th class="text-center" style="width: 20%; min-width: 100px;"> BUTTON TEXT </th>
                                        <th class="text-center" style="width: 25%; min-width: 100px;"> IMAGE LINK </th>
                                        <th class="text-center" style="width: 100px; min-width: 100px;"> STATUS </th>
                                        <th class="text-center" style="width: 100px; min-width: 100px;"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>x
                                    @foreach($carousel as $key => $value)
                                    <tr style="font-size: 9pt;">
                                        <td class="text-center" style="vertical-align: middle;">
                                            {{ $value->parentClass->group_name ?? "" }}
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="#showimage{{ $value->carousel_id }}" data-toggle="modal" class="">
                                                <i class="fa fa-photo"></i> Image
                                            </a>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $value->carousel_text }}</td>
                                        <td style="vertical-align: middle;">{{ $value->carousel_btn_text }}</td>
                                        <td style="vertical-align: middle; max-width: 250px; text-overflow: ellipsis; overflow: hidden;">{{ $value->carousel_link }}</td>
                                        <td class="text-center">
                                            <i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->carousel_id }}" onclick="return updateStatus(this.id,'{{ route('website.route', ['path' => $path , 'action' => 'admin-toggle-head-carousel', 'id' => encrypt($value->carousel_id) ]) }}')" style="font-size: 20px; cursor: pointer;"></i>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="#modalupdatecarousel{{ $value->carousel_id }}" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('website.route', ['path' => $path , 'action' => 'admin-delete-head-carousel', 'id' => encrypt($value->carousel_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row">       
                                <div class="panel-body">             
                                    @foreach($carousel as $key => $value)
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="col-md-12" style="margin-bottom: 15px; box-shadow: 1px 1px 5px 1px #f7f5f5;">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <img src="{{ asset($value->carousel_path) }}" class="img-thumbnail" style="height: auto; width: 100%;" alt="{{ $value->carousel_text }}">
                                                        </div>
                                                        <div class="col-sm-6" style="overflow-x: scroll;">
                                                            <table class="table table-bordered table-hover">
                                                                <tr style="font-size: 9pt;">
                                                                    <td style="width: 100px; padding: 5px;"> <b>DESCRIPTION: </b></td>
                                                                    <td style="width: 50%; padding: 5px;"> {{ $value->carousel_text }} </td>
                                                                </tr>
                                                                <tr style="font-size: 9pt;">
                                                                    <td style="width: 100px; padding: 5px;"> <b>BUTTON TEXT:</b> </td>
                                                                    <td style="width: 50%; padding: 5px;"> {{ $value->carousel_btn_text }} </td>
                                                                </tr>
                                                                <tr style="font-size: 9pt;">
                                                                    <td style="width: 100px; padding: 5px;"> <b>BUTTON LINK:</b> </td>
                                                                    <td style="width: 50%; padding: 5px;"> {{ $value->carousel_link }} </td>
                                                                </tr>
                                                                <tr style="font-size: 9pt;">
                                                                    <td style="width: 100px; padding: 5px;"> <b>STATUS:</b> </td>
                                                                    <td style="width: 50%; padding: 5px;"> 
                                                                        {{ ($value->status) ? 'Active' : 'Inactive' }} 
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size: 9pt;">
                                                                    <td style="width: 100px; padding: 5px;"> <b>ACTION:</b> </td>
                                                                    <td style="width: 50%; padding: 5px;">

                                                                        <a href="#modalupdatecarousel{{ $value->carousel_id }}" data-toggle="modal" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-edit"></i></a>

                                                                        <a href="{{ route('website.route', ['path' => $path , 'action' => 'admin-delete-head-carousel', 'id' => encrypt($value->carousel_id) ]) }}" onclick="return confirm('Are you sure you want to delete this row?')" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-trash"></i></a>

                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
</div>

@foreach($carousel as $key => $value)

    @include('pages.admin.government.modal.modalcarouselimage', ['imagepath' => $value->carousel_path,'id' => $value->carousel_id])
        
    @include('pages.admin.government.modal.modalupdatecarousel',['imagepath' => $value->carousel_path,'id' => $value->carousel_id])

@endforeach

@include('pages.admin.government.modal.modaladdcarousel')

@include('pages.admin.government.modal.modaladdcarouselgroup')

@push('scripts')
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

    function tooglestatus(url,stat)
    {
        $.get(url,{status:stat},function(count){ });
    }

</script>
@endpush

@endsection

