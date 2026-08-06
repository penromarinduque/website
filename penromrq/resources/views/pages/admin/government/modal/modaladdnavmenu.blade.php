<div id="modaladdnavmenu" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form role="form" method="post" action="{{ route('website.route',['path' => 'top-navigation-setup', 'action' => 'admin-create-users-navmenu', 'id' => Crypt::encrypt('')]) }}"> {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> ADD WEBSITE MENU </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="main_class"> MENU CLASS </label>
                        <input type="hidden" name="head_id" id="nav_head_id" value="{{ $head_id }}">
                        <select class="form-control" id="main_class" name="nav_parent" required>
                            <option value="0"> Main Class </option>
                            @foreach( app('NavHeaderDetails')->where([ [ 'status' , 1 ] , [ 'nav_type' , 1 ],['head_id' , $head_id] ])->get() as $key => $value)
                            <option value="{{ $value->nav_id }}"> {{ $value->nav_name }} </option>
                            @endforeach
                        </select>
                        <p class="help-block">Select if menu has a parent</p>
                    </div>
                    <div class="form-group">
                        <label for="nav_type"> MENU TYPE </label>
                        <select class="form-control" id="nav_type" name="nav_type" data-toggle="tooltip" title="Navigation Type" required>
                            <option value="0"> WITHOUT SUB </option>
                            <option value="1"> WITH SUB </option>
                        </select>
                    </div>
                    <div class="form-group @if($errors->has('nav_name')) has-error @endif">
                        <label for="description"> MENU DESCRIPTION </label>
                        <input type="text" class="form-control" name="nav_name" placeholder="Description" autocomplete="off">
                        @if ($errors->has('nav_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nav_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tab_type"> TAB INDEX </label> <span class="help-inline">Open in new tab?</span> 
                        <select class="form-control" id="tab_type" name="tab_type" data-toggle="tooltip" title="Open in new tab" required>
                            <option value="1"> YES </option>
                            <option value="0"> NO </option>
                        </select>
                    </div>
                    <div class="form-group @if($errors->has('nav_path')) has-error @endif" required>
                        <label for="nav_path"> MENU PATH/URL </label>
                        <div class="input-group">
                            <span class="input-group-addon bg-gray">{{ request()->root() }}/website/</span>
                            <input type="text" class="form-control" id="nav_path" name="nav_path" placeholder="your-path (must be unique)" autocomplete="off">
                            <span class="input-group-addon" data-toggle="tooltip" title="With Directory">
                                <input type="checkbox" name="with_directory" style="width: 16px; height: 16px;">
                            </span>
                        </div>
                        @if($errors->has('nav_path'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nav_path') }}</strong>
                        </span>
                        @endif
                        <p class="help-block">Do not use space or special character's</p>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> CLOSE </button>
                </div>
            </div>
        </form>
    </div>
</div>