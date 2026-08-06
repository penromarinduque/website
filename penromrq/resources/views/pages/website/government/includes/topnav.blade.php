<nav class="navbar navbar-inverse nav-fixed">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://www.gov.ph/">
                <img src="{{ asset('web/images/logo/coa-footer-82x921.png') }}" style="max-height: 35px; top: -8px; position: relative;">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                @include('pages.website.government.includes.includenavdetails', [ 'class' => $webdata->getNavHeader(null,1), 'menuclass' => 'dropdown'])
                <li style="display: none;">
                    <a href="{{ route('website.page',['path' => 'contact-us']) }}" target="_blank">
                        Contact Us
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="max-width: 93%; margin-left:15px;">
                    <form class="navbar-form navbar-right" action="/penro/search-result">
                        <div class="input-group">
                            <input type="text" class="form-control" style="border-radius: 0px; box-shadow:none;" placeholder="Search" name="search" value="{{ request()->search }}">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" style="border-radius: 0px;">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>