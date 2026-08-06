@extends('layouts.layout')
@section('title', 'GAD | Video Setup')
@section('content')
<section class="content-header">
    <h1> &nbsp; </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active"><i class="fa fa-folder-o"></i> Video Setup </li>
    </ol>
</section>
<section class="content">
    @include('errors.alerts')
    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: white;">
                    <h3 class="panel-title pull-left">
                        <label><i class="fa fa-folder-o"></i> VIDEO SETUP </label>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="nav-tabs-custom"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#allcontent" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL VIDEO </b></a></li>
                            <li><a href="#newcontent" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD VIDEO </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="allcontent">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-gray-light">
                                    <tr>
                                        <th class="text-center col-sm-3"> DESCRIPTION </th>
                                        <th class="text-center col-sm-3"> TABS </th>
                                        <th class="text-center col-sm-3"> STATUS </th>
                                        <th class="text-center col-sm-3"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $webdata->gender_retrieve_all_videos() as $key => $value)
                                    <tr>
                                        <td>
                                            <a href="#modalcalendarimage{{ $value->files->file_id }}" data-toggle="modal">{{ $value->files->file_name }}</a>
                                            @include('pages.admin.gender.modal.modalcalendarimage')
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <i class="{{ ($value->files->file_tab == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->files->file_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-gender-posts', 'id'
                                             => Crypt::encrypt($value->files->file_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <i class="{{ ($value->files->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->files->file_id }}" onclick="return updateStatus(this.id,'{{ route('gender.route',['path' => $path, 'action' => 'gender-toggle-gender-posts', 'id'
                                             => Crypt::encrypt($value->files->file_id) ]) }}')" style="font-size: 25px; cursor: pointer;"></i>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-edit-posts','id' => Crypt::encrypt($value->files->file_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('gender.route',['path' => $path,'action' => 'gender-delete-posts','id' => Crypt::encrypt($value->files->file_id)]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this row?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{ $webdata->gender_retrieve_all_videos()->links('pages.admin.gender.includes.genderpagination') }}</td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                        <div class="tab-pane fade" id="add">

                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection