<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-create-activity' , 'id' => Crypt::encrypt('4')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <input type="hidden" name="panel_id" value="{{ $GenderPanel->panel_id }}">
    <div class="form-group">
        <label> IMAGE </label>
        <input type="file" id="addimage1" name="image1" class="form-control" onchange="return ValidateFileUpload(this.id)" required>
    </div>
    <div class="form-group">
        <label> DESCRIPTION </label>
        <textarea class="form-control" name="description" style="resize: vertical;min-height: 80px;" autocomplete="off" required></textarea>
    </div>
    <div class="form-group">
        <label> PUBLISHED BY </label>
        <input type="text" class="form-control" name="published_by" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label> PUBLISHED DATE </label>
        <input type="date" class="form-control" name="published_date" required value="{{ date('Y-m-d') }}">
    </div>
    <div class="form-group">
        <label> FULL DESCRIPTION </label>
        <button type="button" data-toggle="modal" data-target="#modaladdimagetopost" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Image </button>
        <span class="help-block"> To create an anchor tag: Highlight first the text and select insert link button to add link. </span>
        <textarea class="ckeditor" name="full_description" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
    </div>
    <div class="form-group">
        <label> DESCRIPTION LINK <i><small>(Optional)</small></i></label>
        <input type="text" class="form-control" name="description_link">
    </div>
    <div class="box-tools text-right">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-save fa-fw"></i> SUBMIT 
        </button>
    </div>
</form>