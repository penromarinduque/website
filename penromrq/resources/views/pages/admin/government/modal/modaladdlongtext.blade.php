<div class="modal fade" id="modaladdlongtext">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-plus"></i> ADD LONGTEXT / PARAGRAPH </h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-info">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#createnewlongtext" onclick="return submitForms('btn_add')" data-toggle="tab"><i class="fa fa-plus"></i> CREATE NEW </a> 
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content" style="height: 60vh; overflow-y: auto;">
                            <div class="tab-pane fade in active" id="createnewlongtext">
                                <form method="post" id="formaddlongtext" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-longtext', 'id' => Crypt::encrypt('')]) }}"> {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="panel_id" class="set_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="long_description"> TITLE / DESCRIPTION </label>
                                        <input type="text" class="form-control" id="long_description" name="long_description" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="long_text"> CREATE PARAGRAPH </label>
                                        <span class="help-block">To create an anchor tag: Highlight first the text and select insert link button to add link.</span>
                                        <textarea class="form-control ckeditor" id="long_text" name="long_text" style="font-size: 12px; height: 35vh"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="addexistslongtext">
                                <form method="post" id="formsetlongtext" action="{{ route('website.route',['path' => $path, 'admin-add-panel-details', 'id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                                    @foreach(app('PanelDetailsLongText')->where('status','1')->orderBy('text_id','desc')->orderBy('created_date','desc')->orderBy('order_level','desc')->get() as $key => $value)
                                    <div class="col-sm-12">
                                        <div class="panel panel-default" id="toggle_class_longtext{{ $value->text_id }}" class="long_text_view">
                                            <div class="panel-heading">
                                                <div style="font-weight: bold; color: green; text-align: center;">{{ $value->long_description }}</div>
                                            </div>
                                            <div class="panel-body">
                                                <input type="hidden" name="panel[{{$key}}][detail_type]" value="3">
                                                <input type="hidden" name="panel[{{$key}}][panel_id]" class="set_id">
                                            </div>
                                            <div class="panel-footer clearfix">
                                                <div class="form-group pull-left no-margin">
                                                    <label style="color: gray">{{ $value->created_date }}</label>
                                                </div>
                                                <div class="form-group pull-right no-margin">
                                                    <label style="color: green; cursor: pointer;"> 
                                                        <input type="checkbox" onclick="return toogleCheck('_longtext{{ $value->text_id }}')" style="height: 16px; width: 16px; margin-top: 2px; position: absolute;" name="panel[{{$key}}][checkbox_id]" id="checkbox_longtext{{ $value->text_id }}" value="{{ $value->text_id }}"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELECT HERE 
                                                    </label>
                                                </div>
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
            <div class="modal-footer">

                <button type="button" onclick="document.getElementById('formsetlongtext').submit()" class="btn btn-primary btn-sm btn_select" style="display: none;">
                    <i class="fa fa-save"></i> SAVE 
                </button>

                <button type="button" onclick="document.getElementById('formaddlongtext').submit()" class="btn btn-primary btn-sm btn_add">
                    <i class="fa fa-save"></i> SUBMIT
                </button>

                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>

            </div>
        </div>
    </div>
</div>