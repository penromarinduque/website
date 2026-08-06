@foreach($class as $key => $subclass)
<tr style="font-size: 10px;">
	<td class="text-center no-padding" style="top: 15;">
		<input type="checkbox" class="checkbox" name="row[{{$subclass->nav_id}}][checked]" style="width: 15px; height: 15px; top: 5px; left:8px;position: relative;">
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_name]" value="{{ $subclass->nav_name }}">
	</td>
	<td class="no-padding">
		<select class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_parent]">
			<option value="0"> Main Class </option>
			@foreach($subclass->nav_sub as $key => $parent)
			<option value="{{ $parent->nav_id }}" @if($parent->nav_id == $subclass->nav_parent) selected @endif>
				{{ $parent->nav_name }}
			</option>
			@endforeach
		</select>
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_href]" value="{{ $subclass->nav_href }}">
		<input type="hidden" name="row[{{$subclass->nav_id}}][nav_link]" value="{{ $subclass->nav_link }}">
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_path]" value="{{ $subclass->nav_path }}">
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_blade]" value="{{ $subclass->nav_blade }}">
	</td>
	<td class="no-padding">
		<select class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_tab]" style="padding-left: 2px; padding-right: 2px;">
			<option value="0" @ @if($subclass->nav_tab == '0') selected @endif> DEFAULT </option>
			<option value="1" @ @if($subclass->nav_tab == '1') selected @endif> NEW TAB </option>
		</select>
	</td>
	<td class="no-padding">
		<select class="form-control input-sm" name="row[{{$subclass->nav_id}}][nav_type]" style="padding-left: 2px; padding-right: 2px;">
			<option value="1" @ @if($subclass->nav_type == '1') selected @endif> W/ DD </option>
			<option value="0" @ @if($subclass->nav_type == '0') selected @endif> W/O DD </option>
		</select>
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="row[{{$subclass->nav_id}}][order_level]" value="{{ $subclass->order_level }}" @if($subclass->menu_type == '1') checked @endif style="padding-right: 2px; padding-left: 2px; text-align: center;">
	</td>
	<td class="text-center no-padding">
		<a href="{{ route('website.route',['path' => 'top-navigation-setup', 'action' => 'admin-delete-users-navmenu', 'id' => Crypt::encrypt($subclass->nav_id)]) }}" class="btn  btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this menu?')" style="position: relative; top: 6px;">
			<span class="fa fa-trash"></span></a>
	</td>
</tr>

@include('pages.admin.government.navigationdetails', [ 'class' => $subclass->nav_sub , 'head_id' => $head_id])

@endforeach