<form id="updateformdetail{{ $value->panel_dtl_id }}" method="post" action="{{ route('website.route',['path' => $path, 'admin-update-storage-files', 'id' => Crypt::encrypt($value->panel_dtl_parent_obj)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="form-group">
        <label for="order_level"> ORDER LEVEL </label>
        <input type="hidden" name="detail_id" value="{{ Crypt::encrypt($value->panel_dtl_id) }}">
        <input type="text" class="form-control" id="order_level" name="order_level" value="{{ $value->order_level }}">
    </div>
    <div class="form-group">
        <label for="file_type"> FILE TYPE </label>
        <select class="form-control" id="file_type" name="file_type" required>
            <option value="" > --Select File Type-- </option>
            <option value="I" @if($value->storage['file_type'] == 'I') selected @endif> Image </option>
            <option value="D" @if($value->storage['file_type'] == 'D') selected @endif> Document </option>
            <option value="V" @if($value->storage['file_type'] == 'V') selected @endif> Video </option>
        </select>
    </div>
    <div class="form-group">
        <label for="file_name"> FILE NAME </label>
        <input type="text" class="form-control" id="file_name" name="file_name" value="{{ $value->storage['file_name'] }}">
    </div>
    <div class="form-group">
        <label for="file_path"> FILE UPLOAD </label>
        <input type="file" class="form-control" id="file_path" name="file_path">
    </div>
    <div class="form-group">
        <label for="file_link"> FILE LINK </label>
        <input type="text" class="form-control" id="file_link" name="file_link" value="{{ $value->storage['file_link'] }}">
    </div>
    <div class="form-group">
        <label for="close_date"> CLOSING DATE </label><small>For Bidding only</small>
        <input type="datetime-local" class="form-control" id="close_date" name="close_date" value="{{ date('Y-m-d\TH:i:s',strtotime($value->storage['closing_date'])) }}">
    </div>
    <div class="form-group">
        <label for="file_tab"> FILE TAB </label>
        <select class="form-control" id="file_tab" name="file_tab" required>
            <option value="0" @if($value->storage['file_tab'] == 0) selected @endif> No Action </option>
            <option value="1" @if($value->storage['file_tab'] == 1) selected @endif> Open in new tab </option>
        </select>
    </div>
</form>