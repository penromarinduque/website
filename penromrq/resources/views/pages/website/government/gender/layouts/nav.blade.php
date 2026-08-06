<nav class="navbar navbar-expand-lg sticky-top navbar-light py-3" id="main_navbar" style="background-color: #4f31a3 !important;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">
            <img src="http://gad.penromarinduque.gov.ph/FMB Gender and Development_files/logos-1.png" width="30" height="30" class="d-inline-block align-top" alt=""> PENRO Gender and Development 
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav navbar-right ml-auto">
                <li class="nav-item active">
                    <a class="nav-link js-scroll-trigger text-white" href="https://www.gov.ph"> GOVPH </a>
                </li>

                <?php 
                    $navbar = app('GenderNavBarDetails')->where('detail_parent','0')->where('status','1')->orderBy('order_level','asc')->get();
                ?>

                @include('pages.website.gender.layouts.navdetails',['navbar' => $navbar])
             
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-link my-2 my-sm-0 text-white" type="button" data-toggle="collapse" data-target="#searchbar"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>

<div class="collapse sticky-top" id="searchbar" style="background-color: #4f31a3 !important;">
    <div class="container py-3">
        <form method="get" action="{{ route('gad.page',['path' => 'search','action' => 'search-result','id' => str_random(10)]) }}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-default bg-white" type="submit" style="border: 1px solid #ced4da;"><i class="fa fa-search"></i></button>
                    <button class="btn btn-default bg-white" type="button" data-toggle="collapse" data-target="#searchbar" style="border: 1px solid #ced4da;"><i class="fa fa-remove"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
