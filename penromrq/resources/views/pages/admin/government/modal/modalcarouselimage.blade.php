<div class="modal fade" data-backdrop="static" id="showimage{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
                <h4 class="modal-title"><i class="fa fa-photo fa-fw"></i> Photo  </h4>
            </div>
            <div class="modal-body">
                <img src="{{ asset($imagepath) }}" class="img-thumbnail" style="height: 35vh; width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
            </div>
        </div>
    </div>
</div>

