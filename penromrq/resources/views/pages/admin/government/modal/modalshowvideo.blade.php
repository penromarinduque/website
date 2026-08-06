<div class="modal fade" id="showVideoModal{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Video </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! $playvideo !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
            </div>
        </div>
    </div>
</div>