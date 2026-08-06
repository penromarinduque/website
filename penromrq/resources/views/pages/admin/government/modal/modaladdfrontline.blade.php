<div class="modal fade" data-backdrop="static" id="modaladdfrontline">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i> Add Frontline Services </h4>
            </div>
            <div class="modal-body">
                <form method="post" id="submitfrontline" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-frontline', 'id' => '1']) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" class="form-control" name="front_link">
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <input type="text" class="form-control" name="front_text">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="front_image_path">
                    </div>
                    <div class="form-group">
                        <label>Open in new tab? <input type="checkbox" name="target_blank" value="1" style="height: 16px; width: 16px; margin-left: 10px; vertical-align: -3px;"></label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="return document.getElementById('submitfrontline').submit()"><i class="fa fa-check"></i> Submit </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
            </div>
        </div>
    </div>
</div>