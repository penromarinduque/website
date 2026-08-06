<div class="modal fade" id="detailmodal{{$detail->detail_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-bars fa-fw"></i> Image </h4>
            </div>
            <div class="modal-body">
                <div class="form-group text-right">
                    <label style="cursor: pointer;"> Background Color <input type="checkbox" id="imagecheckbox{{$detail->detail_id}}" onchange="return changebgcolor({{$detail->detail_id}})" checked style="height: 15px; width: 15px; position: relative;top:3px;cursor: pointer;"> </label>
                </div>
                <div class="form-group text-center bg-dark" id="imagebackcolor{{$detail->detail_id}}" style="padding-top: 40px;padding-bottom: 40px;">
                    <img src="{{ asset($detail->footer_text) }}" class="img-thumbnail bg-dark" style="height: 200px; padding: 10px; background-color: transparent;">
                </div>
                <div class="form-group text-left">
                    <label> Change Image </label>
                    <input type="file" class="form-control" name="footer_text[]">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
            </div>
        </div>
    </div>
</div>