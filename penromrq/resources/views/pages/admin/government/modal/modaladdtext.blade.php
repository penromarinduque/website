<div class="modal fade" id="modaladdnewtext">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-plus"></i> ADD LINKS & TEXTS </h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#createnewinputtext" onclick="return submitForms('btn_add')" data-toggle="tab"><i class="fa fa-plus"></i> CREATE NEW </a> 
                            </li>
                            <li>
                                <a href="#addexistsinputtext" onclick="return submitForms('btn_select')" data-toggle="tab"><i class="fa fa-search"></i> SELECT FROM </a> 
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content" style="height: 40vh; overflow-y: auto;">
                            <div class="tab-pane fade in active" id="createnewinputtext">
                                <form method="post" id="formaddinputtext" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-inputtext', 'id' => Crypt::encrypt('')]) }}"> {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="panel_id" class="set_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="text_name"> TEXT DESCRIPTION </label>
                                        <input type="text" class="form-control" id="text_name" name="text_name" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="text_path"> TEXT LINK </label>
                                        <input type="text" class="form-control" id="text_path" name="text_path" placeholder="www.example.com" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="text_tab"> TEXT TAB </label>
                                        <select class="form-control" id="text_tab" name="text_tab" required>
                                            <option value="0"> No Action </option>
                                            <option value="1"> Open New Tab  </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="addexistsinputtext">
                                <div class="row">
                                    <form method="post" id="formsetinputtext" action="{{ route('website.route',['path' => $path, 'admin-add-panel-details', 'id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                                        @foreach(app('PanelDetailsInputText')->where('status','1')->orderBy('order_level','ASC')->get() as $key => $value)
                                        <div class="col-sm-12">
                                            <div class="panel panel-info">
                                                <div id="toggle_class_inputtext{{ $value->text_id }}" class="longtext-list-view">
                                                    <div class="form-group">
                                                        <label> DESCRIPTION: </label> {{ $value->text_description }} <br>
                                                        <label> LINK: </label> {{ $value->text_link }}
                                                    </div>
                                                    <input type="hidden" name="panel[{{$key}}][detail_type]" value="4">
                                                    <input type="hidden" name="panel[{{$key}}][panel_id]" class="set_id">
                                                </div>
                                                <div class="pane panel-heading clearfix">
                                                    <input type="checkbox" class="pull-right" onclick="return toogleCheck('_inputtext{{ $value->text_id }}')" style="height: 16px; width: 16px;" name="panel[{{$key}}][checkbox_id]" id="checkbox_inputtext{{ $value->text_id }}"  value="{{ $value->text_id }}">
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
                
                <button type="button" onclick="document.getElementById('formsetinputtext').submit()" class="btn btn-primary btn-sm btn_select" style="display: none;">
                    <i class="fa fa-save"></i> SAVE 
                </button>

                <button type="button" onclick="document.getElementById('formaddinputtext').submit()" class="btn btn-primary btn-sm btn_add">
                    <i class="fa fa-save"></i> SUBMIT
                </button>

                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>

            </div>
        </div>
    </div>
</div>