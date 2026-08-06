@foreach($storage_image as $key => $image)
<div class="col-sm-6">
    <div class="box box-default box-solid">
        <div class="box-body" style="height: 150px; overflow: hidden;">
            <img src="{{ asset($image->file_path) }}" style="width: 100%;">
        </div>
        <div class="box-footer">
            <div class="input-group margin">
                <input type="text" id="image_path{{ $image->storage_id }}" class="form-control input-sm" value="{{ request()->root().'/'.$image->file_path }}">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success btn-sm btn-flat" onclick="return copytoclipboard('image_path{{ $image->storage_id }}')">COPY</button>
                </span>
            </div>
        </div>
    </div>
</div>
@endforeach