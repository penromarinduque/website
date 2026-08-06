<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-create-narrative-report' , 'id' => encrypt('3')]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="panel_id" value="{{ $GenderPanel->panel_id }}">
                    <div class="form-group">
                        <label> REPORT AUTHOR </label>
                        <input type="text" class="form-control" name="number" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label> REPORT TITLE </label>
                        <textarea class="form-control" name="description" required style="resize: vertical;"></textarea>
                    </div>
                    <div class="form-group">
                        <label> REPORT LINK </label>
                        <input type="text" class="form-control" name="link" autocomplete="off">
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