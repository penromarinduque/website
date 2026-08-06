@extends('layouts.layout')

@section('title', 'Web Page Setup')

@section('content')

<section class="content-header">
	<h1> &nbsp;</h1>
	<ol class="breadcrumb">
		<li><a href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-folder-o fa-fw"></i> Page Setup </li>
	</ol>
</section>

<div class="content">

	@include('errors.alerts')

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">
						<label><i class="fa fa-folder-o fa-fw"></i> PAGES SETUP </label>
					</h3>
				</div>
				<div class="box-body">
					<div class="col-md-3">
						<div class="panel panel-default" style="height: 77vh;">
							<div class="panel-body" style="padding: 0px;">
								<div class="nav-tabs-custom" style="text-transform: uppercase; font-size: 12px;">
									<ul class="nav nav-tabs nav-justified">
										<li class="@if(count(request()->all()) == '0') active @endif @if(request()->exists('menu_1')) active @endif">
											<a href="#menu1" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?menu_1')" data-toggle="tab">
												<b> {{ app('NavHeader')->where('head_id','1')->first()->head_description }} </b>
											</a>
										</li>
										<li class="@if(request()->exists('menu_2')) active @endif">
											<a href="#menu2" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?menu_2')" data-toggle="tab">
												<b> {{ app('NavHeader')->where('head_id','2')->first()->head_description }} </b>
											</a>
										</li>
										<li class="@if(request()->exists('special')) active @endif">
											<a href="#menu3" onclick="return window.history.replaceState(null, null, '{{ url()->current() }}?special')" data-toggle="tab">
												<b> {{ app('NavHeader')->where('head_id','3')->first()->head_description }} </b>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div style="height: 67vh; overflow-y: auto;">

								<div class="tab-content" style="margin-bottom: 15px;">
									<div class="tab-pane fade in @if(count(request()->all()) == '0') active @endif @if(request()->exists('menu_1')) active @endif" id="menu1">
										<div style="margin-bottom: 10px; text-align: center;">
											<button type="button" class="btn btn-warning btn-sm" onclick="return passHeadId(1)" data-toggle="modal" data-target="#modaladdnavmenu"> 
						                        <i class="fa fa-plus fa-fw"></i> CREATE 
						                    </button>
				        					<a href="/admin/special-pages-setup" class="btn btn-success btn-sm"> 
				                                <i class="fa fa-circle-o fa-fw"></i> SHOW 
				                            </a>
						                </div>
										<div>
											<div class="nav-tabs-custom" style="text-transform: uppercase; font-size: 12px;">
												<ul class="nav nav-default nav-stacked">
													@include('pages.admin.government.includes.pagesetuppages',['class' => $menu1])
												</ul>
											</div>
										</div>
									</div>

									<div class="tab-pane fade in @if(request()->exists('menu_2')) active @endif" id="menu2">
										<div style="margin-bottom: 10px; text-align: center;">
											<button type="button" class="btn btn-warning btn-sm" onclick="return passHeadId(2)" data-toggle="modal" data-target="#modaladdnavmenu"> 
						                        <i class="fa fa-plus fa-fw"></i> CREATE 
						                    </button>
				        					<a href="/admin/special-pages-setup" class="btn btn-success btn-sm"> 
				                                <i class="fa fa-circle-o fa-fw"></i> SHOW 
				                            </a>
						                </div>
										<div>
											<div class="nav-tabs-custom" style="text-transform: uppercase; font-size: 12px;">
												<ul class="nav nav-default nav-stacked">
													@include('pages.admin.government.includes.pagesetuppages',['class' => $menu2])
												</ul>
											</div>
										</div>
									</div>

									<div class="tab-pane fade in @if(request()->exists('special')) active @endif" id="menu3">
										<div style="margin-bottom: 10px; text-align: center;">
											<button type="button" class="btn btn-warning btn-sm" onclick="return passHeadId(3)" data-toggle="modal" data-target="#modaladdnavmenu"> 
						                        <i class="fa fa-plus fa-fw"></i> CREATE 
						                    </button>
				        					<a href="/admin/special-pages-setup" class="btn btn-success btn-sm"> 
				                                <i class="fa fa-circle-o fa-fw"></i> SHOW 
				                            </a>
						                </div>
										<div>
											<div class="nav-tabs-custom" style="text-transform: uppercase; font-size: 12px;">
												<ul class="nav nav-default nav-stacked">
													@include('pages.admin.government.includes.pagesetuppages',['class' => $menu3])
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="tab-content">
							@include('pages.admin.government.includes.pagesetuppanels',['class' => $menu0 ])
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('pages.admin.government.modal.modaladdnavmenu', ['head_id' => '1'])

		@include('pages.admin.government.modal.modaladdcolumn')

	</div>
</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		function setTorequestedUrl(path)
		{
			console.log(window.location)

			if(window.location.search == '')
			{

				return window.history.replaceState(null, null, window.location.href + '?menu_1&' + path)

			}
				else
			{

				var search = window.location.search;

				if(search.indexOf('?') > 0)
				{

					alert(1)

				}else{

					if(search.split('?')[1].indexOf('&') > 0)
					{
						return window.history.replaceState(null, null, window.location.pathname + '?' + (search.split('&')[0]).replace('?','') + '&' + path)
					}

				}

				return window.history.replaceState(null, null, window.location.href + '&' + path)

			}
		 	
		}

		function confirmDeleteNavmenu(url)
		{
			if(confirm('Are you sure you want to delete this row?'))
			{
				window.location = url;
			}
		}

		function passHeadId(int)
		{
			console.log(int);
			$('#nav_head_id').val(int);
		}

		function sendRequest(id){
			$('#panel_nav').val(id);
		}

	</script>
@endsection