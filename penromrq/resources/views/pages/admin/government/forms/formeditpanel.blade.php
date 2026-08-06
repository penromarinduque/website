<form method="post" action="{{ route('website.route',['path' => $path, 'admin-edit-panel-column', 'id' => Crypt::encrypt($panel->panel_id)]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="panel panel-default">
	    <div class="panel-body">
	        <div class="form-group">
	            <label for="panel_name"> PANEL DESCRIPTION </label>
	            <input type="text" class="form-control" id="panel_name" name="panel_name" value="{{ $panel->panel_name }}" required autocomplete="off">
	        </div>
	        <div class="form-group">
	            <label for="panel_class"> PANEL CLASS </label>
	            <select class="form-control" id="panel_class" name="panel_class" required>
	                <option value="" @if($panel->panel_class == '') selected @endif> Select Panel Class </option>
	                <option value="panel panel-default" @if($panel->panel_class == 'panel panel-default') selected @endif>Panel Default - Recommended </option>
	            </select>
	        </div>
	        <div class="form-group">
	            <label for="panel_size"> PANEL SIZE </label>
	            <select class="form-control" id="panel_sizes" name="panel_sizes" required>
	                <option value="" @if($panel->panel_size == '') selected @endif> Select Panel Size </option>
	                <option value="col-md-1" @if($panel->panel_size == 'col-md-1') selected @endif> Column 1 </option>
	                <option value="col-md-2" @if($panel->panel_size == 'col-md-2') selected @endif> Column 2 </option>
	                <option value="col-md-3" @if($panel->panel_size == 'col-md-3') selected @endif> Column 3 </option>
	                <option value="col-md-4" @if($panel->panel_size == 'col-md-4') selected @endif> Column 4 </option>
	                <option value="col-md-5" @if($panel->panel_size == 'col-md-5') selected @endif> Column 5 </option>
	                <option value="col-md-6" @if($panel->panel_size == 'col-md-6') selected @endif> Column 6 </option>
	                <option value="col-md-7" @if($panel->panel_size == 'col-md-7') selected @endif> Column 7 </option>
	                <option value="col-md-8" @if($panel->panel_size == 'col-md-8') selected @endif> Column 8 </option>
	                <option value="col-md-9" @if($panel->panel_size == 'col-md-9') selected @endif> Column 9 </option>
	                <option value="col-md-10" @if($panel->panel_size == 'col-md-10') selected @endif> Column 10 </option>
	                <option value="col-md-11" @if($panel->panel_size == 'col-md-11') selected @endif> Column 11 </option>
	                <option value="col-md-12" @if($panel->panel_size == 'col-md-12') selected @endif> Column 12 - Recommended </option>
	            </select>
	        </div>
	        <div class="form-group">
	            <label for="panel_font_size"> PANEL FONT SIZE (Header/Title) </label>
	            <select class="form-control" id="panel_font_size" name="panel_font_size" required>
	                <option value="" @if($panel->font_size == '') selected @endif> Select Font Size </option>
	                <option value="10pt" @if($panel->font_size == '10pt') selected @endif> 10pt </option>
	                <option value="11pt" @if($panel->font_size == '11pt') selected @endif> 11pt </option>
	                <option value="12pt" @if($panel->font_size == '12pt') selected @endif> 12pt </option>
	            </select>
	        </div>
	    </div>
	    <div class="panel-footer text-right">
	        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> UPDATE </button>
	        <button type="button" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> DELETE </button>
	    </div>
	</div>
</form>