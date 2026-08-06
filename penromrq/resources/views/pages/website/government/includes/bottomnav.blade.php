<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar2">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar2">
            <ul class="nav navbar-nav navbar-center" style="white-space: nowrap;">
                @include('pages.website.government.includes.includenavdetails', ['class' => $webdata->getNavHeader(null,2),'menuclass' => 'dropdown'])
            </ul>
        </div>
    </div>
</nav>