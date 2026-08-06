<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-create-featured-videos' , 'id' => Crypt::encrypt('1')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="panel_id" value="{{ $GenderPanel->panel_id }}">
                    <div class="form-group">
                        <label> FEATURED VIDEO DESCRIPTION </label>
                        <textarea class="form-control" name="description" required style="resize: vertical;"></textarea>
                    </div>
                    <div class="form-group">
                        <label> YOUTUBE VIDEO LINK <small>(Recommended)</small></label>
                        <span class="help-block">Use youtube link and will automatically generate the image thumbnail.</span>
                        <input type="text" class="form-control" name="link" autocomplete="off" required>
                    </div>
                    <div class="box-tools text-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-save fa-fw"></i> SUBMIT 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>