<div class="modal fade" id="modaladdnewimage">
    <div class="modal-dialog">
        <form id="form_modaladdimage" method="post" action="" enctype="multipart/form-data"> {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> <i class="fa fa-plus"></i> IMAGE </h4>
                </div>
                <div class="modal-body">
                    <div class="nav-tabs-custom"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#addnewimage" onclick="$('#editor_uploadimage_btn').css('display','inline')" data-toggle="tab">ADD NEW</a></li>
                            <li><a href="#addexistsimage" onclick="$('#editor_uploadimage_btn').css('display','none')" data-toggle="tab">COPY LINK</a></li>
                        </ul>
                    </div>
                    <div id="image_upload_alert"></div>
                    <div class="tab-content" style="height: 50vh; overflow: auto;">
                        <div class="tab-pane active fade in" id="addnewimage">
                            <div class="form-group">
                                <label>UPLOAD IMAGE</label>
                                <input type="file" id="image_to_upload" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="addexistsimage">
                            <div id="new_uploaded_image"></div>
                            <div id="data_uploaded_image"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="editor_uploadimage_btn" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE</button>
                </div>
            </div>
        </form>
    </div>
</div>