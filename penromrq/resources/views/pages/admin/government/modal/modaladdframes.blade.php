<div class="modal fade" id="modaladdframes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-plus"></i> ADD FRAMESET </h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-info">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#createnewframe" onclick="return submitForms('btn_add')" data-toggle="tab"><i class="fa fa-plus"></i> CREATE NEW </a> </li>
                            <li><a href="#addexistsframe" onclick="return submitForms('btn_select')" data-toggle="tab"><i class="fa fa-search"></i> SELECT FROM </a> </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="tab-content" style="height: 60vh; overflow-y: auto;">
                            <div class="tab-pane fade in active" id="createnewframe">
                                <form method="post" id="formaddframeset" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-frameset','id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="panel_id" class="set_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="frame_name"> FRAME NAME </label>
                                        <input type="text" class="form-control" id="frame_name" name="frame_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="frame_thumbnail"> FRAME THUMBNAIL </label>
                                        <input type="file" class="form-control" id="frame_thumbnail" name="frame_thumbnail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="frame_path"> FRAME PATH </label>
                                        <textarea class="form-control" name="frame_path" id="frame_path" style="resize: vertical;" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="frame_tab"> FRAME TAB </label>
                                        <select class="form-control" id="frame_tab" name="frame_tab" required>
                                            <option value="0"> No Action </option>
                                            <option value="1"> Open New Tab </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="addexistsframe">
                                <div class="row">
                                    <form method="post" id="formsetframe" action="{{ route('website.route',['path' => $path, 'admin-add-panel-details', 'id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                                        @foreach(app('PanelDetailsFrameset')->where('status','1')->orderBy('order_level','ASC')->get() as $key => $value)
                                        <div class="col-sm-6">
                                            <div class="panel panel-info">
                                                <div id="toggle_class_frame{{ $value->frame_id }}" class="storage-grid-image">
                                                    <img src="{{ asset($value->frame_thumbnail) }}" class="thumbnail" style="width: 100%;">
                                                    <input type="hidden" name="panel[{{$key}}][detail_type]" value="2">
                                                    <input type="hidden" name="panel[{{$key}}][panel_id]" class="set_id">
                                                </div>
                                                <div class="panel-heading clearfix">
                                                    <input type="checkbox" class="pull-right" onclick="return toogleCheck('_frame{{ $value->frame_id }}')" name="panel[{{$key}}][checkbox_id]" id="checkbox_frame{{ $value->frame_id }}" style="height: 16px; width: 16px;" value="{{ $value->frame_id }}">
                                                </div>
                                            </div>  
                                        </div>  
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" onclick="document.getElementById('formsetframe').submit()" class="btn btn-primary btn-sm btn_select" style="display: none;">
                    <i class="fa fa-save"></i> SAVE 
                </button>

                <button type="button" onclick="document.getElementById('formaddframeset').submit()" class="btn btn-primary btn-sm btn_add">
                    <i class="fa fa-save"></i> SUBMIT
                </button>

                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                
            </div>
        </div>
    </div>
</div>