@if(isset($withAccessTab))
<div class="col-md-12">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="text-center" style="width: 24%;">
				<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Company </a>
			</li>
			<li class="text-center" style="width: 24%;">
				<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-module', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Module </a>
			</li>
			<li class="text-center" style="width: 24%;">
				<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-window', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Window </a>
			</li>
			<li class="text-center" style="width: 24%;">
				<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-method', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-user fa-fw"></i> Users Method/Role </a>
			</li>
		</ul>
	</div>
</div>
@endif