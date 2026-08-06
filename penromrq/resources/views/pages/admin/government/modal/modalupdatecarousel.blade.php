<div class="modal fade" data-backdrop="static" id="modalupdatecarousel{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="text-left" action="{{ route('website.route',['path' => $path , 'action' => 'admin-update-carousel', 'id' => Crypt::encrypt($id)]) }}" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> UPDATE CAROUSEL </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file"> UPDATE IMAGE </label>
                        <input type="file" class="form-control" name="carousel_path">
                    </div>
                    <div class="form-group">
                        <label for=""> UPDATE DESCRIPTION </label>
                        <input type="text" class="form-control" name="carousel_text" value="{{ $value->carousel_text }}" required>
                    </div>
                    <div class="form-group">
                        <label for=""> UPDATE BUTTON TEXT </label>
                        <input type="text" class="form-control" name="carousel_btn_text" value="{{ $value->carousel_btn_text }}" required>
                    </div>
                    <div class="form-group">
                        <label for=""> UPDATE BUTTON LINK </label>
                        <input type="text" class="form-control" name="carousel_link" value="{{ $value->carousel_link }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> UPDATE </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                </div>
            </form>
        </div>
    </div>
</div>