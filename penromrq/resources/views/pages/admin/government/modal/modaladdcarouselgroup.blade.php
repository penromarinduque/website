<div class="modal fade" id="modaladdcarouselgroup">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="{{ route('website.route',['path' => $path , 'action' => 'admin-add-carousel-group', 'id' => Crypt::encrypt('1')]) }}" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> ADD CAROUSEL GROUP </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="group_code"> GROUP CODE </label>
                        <input type="text" class="form-control" id="group_code" name="group_code" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="group_description"> GROUP DESCRIPTION </label>
                        <input type="text" class="form-control" id="group_description" name="group_description" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>