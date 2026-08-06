<form method="post" id="updateformdetail{{ $value->panel_dtl_id }}" action="{{ route('website.route',['path' => $path, 'action' => 'admin-update-frameset','id' => Crypt::encrypt($value->panel_dtl_parent_obj)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="form-group">
        <label for="order_level"> ORDER LEVEL </label>
        <input type="hidden" name="detail_id" value="{{ Crypt::encrypt($value->panel_dtl_id) }}">
        <input type="text" class="form-control" id="order_level" name="order_level" value="{{ $value->order_level }}">
    </div>
    <div class="form-group">
        <label for="frame_name"> FRAME NAME </label>
        <input type="text" class="form-control" id="frame_name" name="frame_name" value="{{ $value->frameset['frame_name'] }}" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label for="frame_thumbnail"> FRAME THUMBNAIL </label>
        <input type="file" class="form-control" id="frame_thumbnail" name="frame_thumbnail" required>
        <p class="help-block small">UPLOAD NEW TO UPDATE</p>
    </div>
    <div class="form-group">
        <label for="frame_path"> FRAME PATH </label>
        <textarea class="form-control" name="frame_path" id="frame_path" style="resize: vertical; height: 25vh;" required>{!! $value->frameset['frame_path'] !!}</textarea>
    </div>
    <div class="form-group">
        <label for="frame_tab"> FRAME TAB </label>
        <select class="form-control" id="frame_tab" name="frame_tab" required>
            <option value="0"> No Action </option>
            <option value="1"> Open in new tab </option>
        </select>
    </div>
</form>