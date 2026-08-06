<form method="post" action="{{ route('gender.route',['path' => $path, 'action' => 'gender-update-minutes-of-meeting' , 'id' => encrypt($PanelLinks->link_id)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="panel_id" value="{{ $GenderPanel->panel_id }}">
                    <div class="form-group">
                        <label> MEETING DATE </label>
                        <input type="date" class="form-control" name="number" autocomplete="off" value="{{ $PanelLinks->link_code }}" required>
                    </div>
                    <div class="form-group">
                        <label> MEETING TITLE/DESCRIPTION </label>
                        <textarea class="form-control" name="description" required style="resize: vertical;">{{ $PanelLinks->link_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label> MEETING LINK </label>
                        <input type="text" class="form-control" name="link" autocomplete="off" value="{{ $PanelLinks->link_path }}">
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