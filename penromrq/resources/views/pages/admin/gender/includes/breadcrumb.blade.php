<h1> {{ $GenderPanel->panel_name }} <small>Control panel</small> </h1>
<ol class="breadcrumb">
    <li><a href="{{ route('gender.route',['path' => 'gender']) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
    <li><a href="{{ route('gender.route',['path' => $path]) }}"><i class="fa fa-folder-o"></i> Page Setup </a></li>
    <li><a href="{{ route('gender.route',['path' => $path, 'action' => 'gender-retrieve-panel', 'id' => encrypt($GenderPanel->detail_id) ]) }}"><i class="fa fa-folder-o"></i> Manage Panel Details </a></li>
    <li class="active"><i class="fa fa-folder-o"></i> {{ title_case($GenderPanel->panel_name) }} </li>
</ol>
