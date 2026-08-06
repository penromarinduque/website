<div class="modal fade" id="modaladdfiles">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-plus"></i> ADD IMAGES / DOCUMENTS </h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#createnew" onclick="return submitForms('btn_add')" data-toggle="tab"><i class="fa fa-plus"></i> CREATE NEW </a> </li>
                            <li><a href="#addexists" onclick="return submitForms('btn_select')" data-toggle="tab"><i class="fa fa-search"></i> SELECT FROM </a> </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content" style="height: 60vh; overflow-y: auto;">
                            <div class="tab-pane fade in active" id="createnew">
                                <form id="formaddfile" method="post" action="{{ route('website.route',['path' => $path, 'admin-add-storage-files', 'id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="panel_id" class="set_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_type"> FILE TYPE </label>
                                        <select class="form-control" id="file_type" name="file_type" required>
                                            <option value=""> --Select File Type-- </option>
                                            <option value="I"> Image </option>
                                            <option value="D"> Document </option>
                                            <option value="V"> Video </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="file_name"> FILE NAME </label>
                                        <input type="text" class="form-control" id="file_name" name="file_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_path"> FILE UPLOAD </label>
                                        <input type="file" class="form-control" id="file_path" name="file_path">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_link"> FILE LINK </label>
                                        <input type="text" class="form-control" id="file_link" name="file_link">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_tab"> FILE TAB </label>
                                        <select class="form-control" id="file_tab" name="file_tab" required>
                                            <option value="0"> No Action </option>
                                            <option value="1"> Default  </option>
                                            <option value="2"> Open New Tab </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="close_date"> CLOSING DATE </label> <small> (For Bidding only) </small>
                                        <input type="datetime-local" class="form-control" id="close_date" name="close_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="bid_result"> BID RESULT </label> <small> (For Bidding result only) </small>
                                        <textarea class="form-control" name="bid_result" id="bid_result" style="resize: vertical;"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="addexists">
                                <div class="row"> 
                                    <form method="post" id="formsetfile" action="{{ route('website.route',['path' => $path, 'admin-add-panel-details', 'id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                                        @foreach(app('PanelDetailsStorage')->where('status','1')->where('file_type','I')->orderBy('order_level','ASC')->get() as $key => $value)
                                            <div class="col-sm-3">
                                                <div id="toggle_class_storage{{ $value->storage_id }}" onclick="return toogleCheck('_storage{{ $value->storage_id }}')" class="storage-grid-image">
                                                    <img src="{{ asset($value->file_path) }}" style="width: 100%;">
                                                    <input type="hidden" name="panel[{{$key}}][detail_type]" value="1">
                                                    <input type="hidden" name="panel[{{$key}}][panel_id]" class="set_id">
                                                    <input type="checkbox" class="hidden-checkbox" name="panel[{{$key}}][checkbox_id]" id="checkbox_storage{{ $value->storage_id }}" value="{{ $value->storage_id }}">
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

                <button type="button" onclick="return document.getElementById('formsetfile').submit()" class="btn btn-primary btn-sm btn_select" style="display: none;">
                    <i class="fa fa-save"></i> SAVE 
                </button>

                <button type="button" onclick="return document.getElementById('formaddfile').submit()" class="btn btn-primary btn-sm btn_add">
                    <i class="fa fa-save"></i> SUBMIT 
                </button>
                
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                
            </div>
        </div>
    </div>
</div>
