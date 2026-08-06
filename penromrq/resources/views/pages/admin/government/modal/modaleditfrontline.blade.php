<div class="modal fade" data-backdrop="static" id="modaleditfrontline{{ $value->front_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
                <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i> ADD FRONTLINE SERVICES </h4>
            </div>
            <div class="modal-body text-left">
                <form method="post" id="updatefrontline{{ $value->front_id }}" action="{{ route('website.route',['path' => $path, 'action' => 'admin-update-frontline','id' => Crypt::encrypt($value->front_id)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>ORDER LEVEL</label>
                                <input type="number" class="form-control" name="order_level" value="{{ $value->order_level }}">
                                <input type="hidden" name="front_id" value="{{ $value->front_id }}">
                            </div>
                            <div class="col-sm-6">
                                <label>OPEN NEW TAB </label>
                                <input type="checkbox" @if($value->target_blank == '1') checked @endif name="target_blank" value="1" style="height: 16px; width: 16px; margin-left: 10px; vertical-align: -3px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>IMAGE LINK</label>
                        <input type="text" class="form-control" name="front_link" value="{{ $value->front_link }}">
                    </div>
                    <div class="form-group">
                        <label>IMAGE DESCRIPTION</label>
                        <input type="text" class="form-control" name="front_text" value="{{ $value->front_text }}">
                    </div>
                    <div class="form-group">
                        <label>CHANGE IMAGE</label><br><center style="background-color: #999;padding-top: 10px; padding-bottom: 10px;">
                        <img class="img-thumbnail" src="{{ asset($value->front_image_path) }}" style="max-height: 200px; background-color: transparent;"></center>
                        <input type="file" class="form-control" name="front_image_path">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm" onclick="return document.getElementById('updatefrontline{{ $value->front_id }}').submit()"><i class="fa fa-save"></i> UPDATE </button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
            </div>
        </div>
    </div>
</div>