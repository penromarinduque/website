<li class="header">SYSTEM MODULE</li>

<li>
    <a href="/welcome" style="text-overflow: ellipsis; overflow: hidden;"> 
        <i class="{{ $activeModule->module_icon }}"></i> <span> {{ strtoupper($activeModule->module_name) }} </span>
    </a>
</li>

<li class="header"> MAIN NAVIGATION </li>

@include('layouts.sidebaraccess')

{{-- <li class="header"> LABELS </li>

<li><a href="#"><i class="fa fa-circle-o text-red"></i> 
    <span>Important</span></a>
</li>
<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> 
    <span>Warning</span></a>
</li>
<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> 
    <span>Information</span></a>
</li> --}}