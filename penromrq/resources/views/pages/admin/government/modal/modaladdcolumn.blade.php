<div class="modal fade" id="modaladdcolumn">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('website.route',['path' => $path, 'admin-add-panel-column', 'id' => Crypt::encrypt('')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> <i class="fa fa-plus"></i> ADD PANEL </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="panel_nav" name="panel_nav">
                    </div>
                    <div class="form-group">
                        <label for="panel_name"> PANEL DESCRIPTION </label>
                        <input type="text" class="form-control" id="panel_name" name="panel_name">
                    </div>
                    <div class="form-group">
                        <label for="panel_class"> PANEL CLASS </label>
                        <select class="form-control" id="panel_class" name="panel_class" required>
                            <option value=""> Select Panel Class </option>
                            <option value="panel panel-default" selected="">Panel Default - Recommended </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="panel_size"> PANEL SIZE </label>
                        <select class="form-control" id="panel_sizes" name="panel_sizes" required>
                            <option value=""> Select Panel Size </option>
                            <option value="col-md-1"> Column 1 </option>
                            <option value="col-md-2"> Column 2 </option>
                            <option value="col-md-3"> Column 3 </option>
                            <option value="col-md-4"> Column 4 </option>
                            <option value="col-md-5"> Column 5 </option>
                            <option value="col-md-6"> Column 6 </option>
                            <option value="col-md-7"> Column 7 </option>
                            <option value="col-md-8"> Column 8 </option>
                            <option value="col-md-9"> Column 9 </option>
                            <option value="col-md-10"> Column 10 </option>
                            <option value="col-md-11"> Column 11 </option>
                            <option value="col-md-12" selected=""> Column 12 - Recommended </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="panel_font_size"> PANEL FONT SIZE (Header/Title) </label>
                        <select class="form-control" id="panel_font_size" name="panel_font_size" required>
                            <option value=""> Select Font Size </option>
                            <option value="10pt"> 10pt </option>
                            <option value="11pt"> 11pt </option>
                            <option value="12pt" selected> 12pt </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                </div>
            </form>
        </div>
    </div>
</div>