<style type="text/css">
    
    .news-image
    {
        width: 100%;
        height: 210px;
        position: static;
        margin-bottom: 10px;
    }

    .news-author
    {
        font-weight: bold;
        font-size: 9pt;
    }

    .news-readmore
    {
        font-weight: bold;
    }

    .story-detail
    {
        text-align: justify;
        max-height: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
    }

    /*.story-detail:after { content: '...'; position: absolute; bottom: 0; right: 0; }*/

    .story-detail p img
    {
        display: none;
    }

    .story-detail p
    {
         /*overflow-wrap: break-word;*/
    }
    
    .content {
        position: absolute;
        bottom: 0;
        background: rgb(0, 0, 0); /* Fallback color */
        background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
        width: 100%;
        padding: 20px;
    }
    
    .content a {
        color: #f1f1f1;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }
    
</style>

<div class="ribbon">
    <div class="ribbon-heading">
        <div class="ribbon-title">
            <i class="fa fa-newspaper-o fa-fw"></i> {{ $webdata->center(1)->center_panel_title }}
            <div class="ribbon-flag"></div>
        </div>
    </div>
    @foreach($webdata->active_news_and_events()->subClass()->paginate(2,['*'],'news-and-event') as $key => $value)
        <div class="ribbon-body">
            <div class="news-content">
                <div class="news-image" style="background-image: url('{{ asset($value->created_image) }}'); background-size: 100% 100%;">
                    {{-- <img src="{{ asset($value->created_image) }}" style="width: 100%; position: relative; z-index: -1;"> --}}
                </div>
                <div class="news-title" style="font-weight: bold; color: green; font-size: 14pt;">
                    <p style="text-align: justify;">{{ $value->created_title }}</p> 
                </div>
                <div class="news-author" style="margin-bottom: 10px;">
                    Written By: {{ $value->published_by }} {{ date('F d, Y',strtotime($value->published_date)) }}
                </div>
                <div class="story-detail">
                    {!! $value->created_story !!}
                </div>
                <div class="news-read-more-a" style="text-align: right; font-weight: bold; margin-bottom: 10px; margin-top:10px;">
                    <a href="{{ route('website.page',['path' => 'news-and-events-spcl', 'action' => 'view-news-and-events', 'id' => Crypt::encrypt($value->detail_id)]) }}"> Read more... </a>
                </div>
            </div>
        </div>
    @endforeach
    <div class="text-right">
        {{ $webdata->active_news_and_events()->subClass()->paginate(2,['*'],'news-and-event')->links('vendor.pagination.default') }}
    </div>
</div>

<div class="panel panel-success" style="margin-bottom: 10px;">
    <div class="panel-heading bg-green">
        <h3 class="panel-title text-white"><b>
            {{ $webdata->active_featured_articles()->center_panel_title }}</b>
        </h3>
    </div>
    <div class="panel-body">
        @foreach($webdata->active_featured_articles()->subClass()->where('status','1')->paginate(1,['*'],'featured-articles') as $key => $article)
            <div class="new-image">
                <img class="news-image" src="{{ config('app.admin_url') . $article->created_image }}" class="pull-top mr-5">
            </div>
            <div class="news-title" style="font-weight: bold; color: green; font-size: 14pt;">
                <p style="text-align: justify;">{{ $article->created_title }}</p> 
            </div>
            <div class="news-author" style="margin-bottom: 10px;">
                Published At: {{ $article->published_by }} {{ date('F d, Y',strtotime($article->published_date)) }}
            </div>
            <div class="story-detail">
                {!! $article->created_story !!}
            </div>
            <div style="margin-top: 15px; text-align: right;">
                <a href="{{ route('website.page',['path' => 'featured-articles', 'action' => 'view-featured-articles', 'id' => Crypt::encrypt($article->detail_id)]) }}" style="text-decoration: none; cursor: pointer;"><b> Read more... </b></a>
            </div>
        @endforeach
    </div>
    <div class="panel-footer text-right" style="padding: 4px; margin-top: 0px;">
        {{ $webdata->active_featured_articles()->subClass()->where('status','1')->paginate(1,['*'],'featured-articles')->links('vendor.pagination.default') }}
    </div>
</div>

<!-- photo releases -->
<div class="panel panel-success">
    <div class="panel-heading bg-green">
        <h3 class="panel-title text-white"><b> {{ $webdata->active_photo_releases()->center_panel_title }} </b></h3>
    </div>
    <div class="panel-body" style="padding: 0px;">
        <div id="myCarousel3" class="carousel slide carousel-custom" data-ride="carousel" data-interval="10000">
            <div class="carousel-inner text-center" role="listbox">
                @foreach($webdata->active_photo_releases()->subClassVidImg()->where('status','1')->get() as $key => $photos)
                <div class="item @if($key == 0) active @endif" style="background-image: url({{ config('app.admin_url') . $photos->vid_img_path }} ); background-size: 100% 100%; height: 300px;">
                    <div class="content"> <a href="#myModalImage{{ $photos->content_id }}" data-toggle="modal">{{ $photos->vid_img_title }}</a> </div>
                </div>

                <div id="myModalImage{{ $photos->content_id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <img src="{{ config('app.admin_url') . $photos->vid_img_path }}" style="width:100%; height: auto;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div> 

<!-- Featured Videos -->
<div class="panel panel-success">
    <div class="panel-heading bg-green">
        <h3 class="panel-title text-white"><b>{{ $webdata->active_featured_videos()->center_panel_title }}</b></h3>
    </div>
    <div class="panel-body" style="padding: 0px;">
        <div id="myCarousel4" class="carousel slide carousel-custom" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner text-center" role="listbox">
                @foreach($webdata->active_featured_videos()->subClassVidImg()->where('status','1')->get() as $key => $videos)
                    <div class="item @if($key == 0) active @endif" style="background-image: url({{ config('app.admin_url') . $videos->vid_img_path }} ); background-size: 100% 100%; height: 300px;">
                        <a href="{{ $videos->vid_img_link }}" target="_blank">
                            <div style="position: absolute; margin: 25%;">
                                <svg height="30%" version="1.1" viewBox="0 0 68 48" width="30%">
                                    <path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#FF0000" fill-opacity="0.9"></path><path d="M 45,24 27,14 27,34" fill="#fff">
                                    </path>
                                </svg>
                            </div>
                        </a>
                        <div class="content">
                            <a href="{{ $videos->vid_img_link }}">{{ $videos->vid_img_title }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel4" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel4" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
