<form method="post" action="{{ route('website.route',['path' => $path, 'action' => 'admin-add-news-and-articles' , 'id' => Crypt::encrypt($center['center_id'])]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="form-group">
        <label> IMAGES </label>
        <div class="row">
            <div class="col-sm-4">
                <input type="file" id="addimage1" name="image1" class="form-control" onchange="return ValidateFileUpload(this.id)" required>
            </div>
            <div class="col-sm-4">
                <input type="file" id="addimage2" name="image2" class="form-control" onchange="return ValidateFileUpload(this.id)">
            </div>
            <div class="col-sm-4">
                <input type="file" id="addimage3" name="image3" class="form-control" onchange="return ValidateFileUpload(this.id)">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label> HEADLINE / TITLE </label>
        <textarea class="form-control" name="created_title" style="resize: vertical;min-height: 100px;" autocomplete="off" required>@if(request()->has('headline_title')){{ request()->headline_title }}@endif</textarea>
    </div>
    <div class="form-group">
        <label> PUBLISHED BY </label>
        <input type="text" class="form-control" name="create_by" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label> PUBLISHED DATE </label>
        <input type="date" class="form-control" name="create_date" required value="{{ date('Y-m-d') }}">
    </div>
    <div class="form-group">
        <label> FULL DESCRIPTION </label>
        <button type="button" onclick="return showModalAddImage()" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Image </button>
        <span class="help-block">To create an anchor tag: Highlight first the text and select insert link button to add link.</span>
        <textarea class="ckeditor" name="wysihtml5" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
    </div>
    <div class="box-tools text-right">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-save fa-fw"></i> SUBMIT 
        </button>
    </div>
</form>