<style type="text/css">
    .carousel-image {
        height: 460px;
    }
</style>
<div class="bg-gray">
    <div class="container" id="carousel-width">
        <div class="carousel-container">
            @if(app('CarouselGroupDetails')->where('status','1')->count() > 0)
            <div id="myCarousel" class="carousel slide carousel-custom" data-ride="carousel" data-interval="5000">
                <ol class="carousel-indicators">
                    @foreach(app('CarouselGroupDetails')->where('status','1')->orderBy('carousel_id','desc')->orderBy('created_date','desc')->get() as $key => $value)
                        <li data-target="#myCarousel" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner" role="listbox">
                    @foreach(app('CarouselGroupDetails')->where('status','1')->orderBy('carousel_id','desc')->orderBy('created_date','desc')->get() as $key => $value)
                        <div class="item @if($key == 0) active @endif">
                            <img src="{{ asset($value->carousel_path) }}" alt="{{ $value->carousel_text }}" class="carousel-image" data-url="{{ asset($value->carousel_path) }}" style="height: 100%;">
                        </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>