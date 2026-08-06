<form method="post" id="updateformdetail{{ $value->panel_dtl_id }}" action="{{ route('website.route',['path' => $path, 'action' => 'admin-update-longtext', 'id' => Crypt::encrypt($value->panel_dtl_parent_obj)]) }}"> {{ csrf_field() }}
	<div class="form-group">
	    <label for="order_level"> ORDER LEVEL </label>
	    <input type="hidden" name="detail_id" value="{{ Crypt::encrypt($value->panel_dtl_id) }}">
	    <input type="text" class="form-control" id="order_level" name="order_level" value="{{ $value->order_level }}">
	</div>
    <div class="form-group">
        <label for="long_description"> TITLE / DESCRIPTION </label>
        <input type="text" class="form-control" id="long_description" name="long_description" value="{{ $value->longtext['long_description'] }}" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="long_text"> CREATE PARAGRAPH </label>
        <span class="help-block">To create an anchor tag: Highlight first the text and select insert link button to add link.</span>
        <textarea class="form-control textarea ckeditor" id="long_text" name="long_text" style="font-size: 12px; height: 35vh">{!! $value->longtext['long_text'] !!}</textarea>
    </div>
</form>