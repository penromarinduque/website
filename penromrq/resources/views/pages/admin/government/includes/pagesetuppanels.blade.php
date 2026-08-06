@foreach($class as $key => $value)
	<div class="tab-pane fade in @if(request()->exists('tab_'.$value->nav_id)) active @endif" id="tab_{{ $value->nav_id }}">
		<div class="panel panel-default" style="height: 77vh;">
			<div class="box-header">
				<h3 class="box-title" style="text-transform: uppercase;">{{ $value->nav_name }}</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-warning btn-sm" onclick="return sendRequest('{{ $value->nav_id }}')" data-toggle="modal" data-target="#modaladdcolumn">
						<i class="fa fa-plus"></i> CREATE 
					</button>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-hover table-striped table-condensed">
					<thead>
						<tr style="font-size: 12px;">
							<th> ID </th>
							<th> DESCRIPTION </th>
							<th> CLASS </th>
							<th> SIZE </th>
							<th> BG-COLOR </th>
							<th> FONT-SIZE </th>
							<th class="text-center"> STATUS </th>
							<th class="text-center"> ACTION </th>
						</tr>
					</thead>
					<tbody>
						@foreach(app('Panel')->where('panel_nav',$value->nav_id)->get() as $key => $panel)
						<tr style="font-size: 12px;">
							<td style="vertical-align: middle;">{{ $panel->order_level }}</td>
							<td style="vertical-align: middle;">{{ $panel->panel_name }}</td>
							<td style="vertical-align: middle;">{{ $panel->panel_class }}</td>
							<td style="vertical-align: middle;">{{ $panel->panel_size }}</td>
							<td style="vertical-align: middle;">{{ $panel->panel_color }}</td>
							<td style="vertical-align: middle;">{{ $panel->font_size }}</td>
							<td class="text-center" style="padding: 5px 0px 0px 0px;">
								<i class="{{ ($panel->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $panel->panel_id }}" onclick="return updateStatus(this.id,'{{ route('website.route',['path' => $path, 'action' => 'admin-toggle-page-setup-details', 'id'
								 => Crypt::encrypt($panel->panel_id) ]) }}')" style="font-size: 22px; cursor: pointer;"></i>
							</td>
							<td class="text-center">
								
								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-dashboard','id' => Crypt::encrypt($panel->panel_id) ]) }}?dashboard" class="btn btn-warning btn-xs" data-toggle="tooltip" title="MANAGE"> <i class="fa fa-pencil"></i> </a>

								<a href="{{ route('website.route',['path' => $path, 'action' => 'admin-page-setup-details','id' => Crypt::encrypt($panel->panel_id) ]) }}?panels" class="btn btn-primary btn-xs" data-toggle="tooltip" title="UPDATE"><i class="fa fa-edit"></i> </a>

								<a href="{{ route('website.route',['path' => $path ,'action' => 'admin-delete-panel-column' , 'id' => Crypt::encrypt($panel->panel_id)]) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this row?')" data-toggle="tooltip" title="DELETE"> <i class="fa fa-trash"></i> </a>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@include('pages.admin.government.includes.pagesetuppanels',['class' => $value->nav_sub ])

@endforeach