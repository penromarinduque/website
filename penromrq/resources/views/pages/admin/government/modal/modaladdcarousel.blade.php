<div class="modal fade" id="addcarousel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="{{ route('website.route',['path' => $path , 'action' => 'admin-add-carousel', 'id' => '1']) }}" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> ADD CAROUSEL/BANNER </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file"> SELECT GROUP </label>
                        <select class="form-control" name="group_id" required>
                            <option value=""> Select Group </option>
                            @foreach(app('CarouselGroup')->where('status','1')->get() as $group)
                            <option value="{{ $group->group_id }}" @if(request()->filter_carousel_group == $group->group_id ) selected @endif> {{ $group->group_code }} - {{ $group->group_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file"> UPLOAD IMAGE </label>
                        <input type="file" class="form-control" name="carousel_path" required>
                    </div>
                    <div class="form-group">
                        <label for=""> DESCRIPTION </label>
                        <input type="text" class="form-control" name="carousel_text" required>
                    </div>
                    <div class="form-group">
                        <label for=""> BUTTON TEXT </label>
                        <input type="text" class="form-control" name="carousel_btn_text" required>
                    </div>
                    <div class="form-group">
                        <label for=""> BUTTON LINK </label>
                        <input type="text" class="form-control" name="carousel_link" required>
                    </div>
                    <div class="form-group">
                        <label for="status"> STATUS </label>
                        <input type="checkbox" id="status" name="carousel_status" value="1" style="height: 16px; width: 16px; position: absolute; margin-top: 2px; margin-left: 10px;" checked>
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