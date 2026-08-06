@foreach($value->subClass()->get() as $key => $detail)
<div class="modal fade" id="editfooterdetail{{ $detail->detail_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('website.route',['path' => 'agency-footer', 'action' => 'admin-update-footer-details', 'id' => Crypt::encrypt($detail->detail_id) ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
                <div class="modal-header text-left">
                    <h4 class="modal-title"><i class="fa fa-edit fa-fw"></i> UPDATE DETAILS </h4>
                </div>
                <div class="modal-body text-left">
                    @if($value->footer_type == 'L')
                    <div class="form-group">
                        <label> DESCRIPTION </label>
                        <input type="text" class="form-control" name="footer_text" value="{{ $detail->footer_text }}" required="required">
                    </div>
                    @endif
                    @if($value->footer_type == 'I')
                    <div class="form-group">
                        <label> UPLOAD IMAGE </label>
                        <input type="file" class="form-control" name="footer_text" required="required">
                    </div>
                    @endif
                    <div class="form-group">
                        <label> ONCLICK LINK </label>
                        <input type="text" class="form-control" name="footer_path" value="{{ $detail->footer_path }}" required="required">
                        <input type="hidden" name="footer_type" value="{{ $value->footer_type }}">
                    </div>
                    <div class="form-group">
                        <label>OPEN IN NEW TAB?</label>
                        <select class="form-control" name="footer_tab">
                            <option value="1" @if($detail->footer_tab == '1') selected @endif>YES</option>
                            <option value="0" @if($detail->footer_tab == '0') selected @endif>NO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-save"></i> UPDATE </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach