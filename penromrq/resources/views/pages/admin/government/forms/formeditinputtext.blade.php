<form method="post" id="updateformdetail{{ $value->panel_dtl_id }}" action="{{ route('website.route',['path' => $path, 'action' => 'admin-update-inputtext', 'id' => Crypt::encrypt($value->panel_dtl_parent_obj)]) }}"> {{ csrf_field() }}
    <div class="form-group">
        <label for="order_level"> ORDER LEVEL </label>
        <input type="hidden" name="detail_id" value="{{ Crypt::encrypt($value->panel_dtl_id) }}">
        <input type="text" class="form-control" id="order_level" name="order_level" value="{{ $value->order_level }}">
    </div>
    <div class="form-group">
        <label for="text_name"> TEXT DESCRIPTION </label>
        <input type="text" class="form-control" id="text_name" name="text_name" value="{{ $value->inputtext['text_description'] }}" required autocomplete="off">
    </div>
    <div class="form-group">
        <label for="text_path"> TEXT LINK </label>
        <input type="text" class="form-control" id="text_path" name="text_path" placeholder="www.example.com" value="{{ $value->inputtext['text_link'] }}" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="text_tab"> TEXT TAB </label>
        <select class="form-control" id="text_tab" name="text_tab" required>
            <option value="0" @if($value->inputtext['text_tab'] == 0) selected @endif> No Action </option>
            <option value="1" @if($value->inputtext['text_tab'] == 1) selected @endif> Open New Tab  </option>
        </select>
    </div>
</form>