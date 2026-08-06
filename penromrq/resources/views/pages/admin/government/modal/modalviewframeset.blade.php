<div class="modal fade" id="modalviewframeset{{ $frame->frame_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-youtube-play"></i> FRAMESET </h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-body myyoutubeclass">
                       {!! $frame_path !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm stopwatchingyoutube" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
            </div>
        </div>
    </div>
</div>

