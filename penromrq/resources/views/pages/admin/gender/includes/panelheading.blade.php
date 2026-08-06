<h3 class="panel-title pull-left">
    <span class="fa fa-angle-double-right fa-fw"></span>
    <label><a href="{{ route('gender.route',['path' => $path]) }}"> PAGE SETUP </a></label> 
    <span class="fa fa-angle-double-right fa-fw"></span>
    <label><a href="{{ route('gender.route',['path' => $path,'action' => 'gender-retrieve-panel','id' => encrypt($GenderPanel->detail_id) ]) }}"> MANAGE PANELS </a></label> 
    <span class="fa fa-angle-double-right fa-fw"></span>
    <label> {{ $GenderPanel->panel_name }} </label>
</h3>