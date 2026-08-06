<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-create-announcement' , 'id' => Crypt::encrypt('1')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="overflow-x: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="panel_id" value="{{ $GenderPanel->panel_id }}">
                    <div class="form-group">
                        <label> ANNOUNCEMENT TITLE </label>
                        <textarea class="form-control" name="description" required style="resize: vertical;"></textarea>
                    </div>
                    <div class="form-group">
                        <label> ANNOUNCEMENT FULL DESCRIPTION </label>
                        <textarea class="ckeditor" name="full_description" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;" required></textarea>
                    </div>
                    <div class="form-group">
                        <label> ANNOUNCEMENT LINK </label>
                        <input type="text" class="form-control" name="description_link" autocomplete="off">
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