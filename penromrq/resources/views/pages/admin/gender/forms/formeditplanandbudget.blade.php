<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-update-plan-and-budget' , 'id' => Crypt::encrypt($PanelFiles->file_id)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="panel_id" value="{{ $GenderPanel->panel_id }}">
                    <div class="form-group">
                        <label> PLAN AND BUDGET </label>
                        <input type="file" class="form-control" name="photo" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label> PLAN AND BUDGET DESCRIPTION </label>
                        <textarea class="form-control" name="description" required style="resize: vertical;">{{ $PanelFiles->file_name }}</textarea>
                    </div>
                    <div class="form-group">
                        <label> PLAN AND BUDGET LINK </label>
                        <input type="text" class="form-control" name="link" autocomplete="off" value="{{ $PanelFiles->file_link }}">
                    </div>
                    <div class="box-tools text-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-save fa-fw"></i> UPDATE 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>