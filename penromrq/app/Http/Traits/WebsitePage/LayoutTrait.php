<?php

namespace App\Http\Traits\WebsitePage;

trait LayoutTrait
{
    public function masterhead()
    {
        return app('MasterHead')->first();
    }

    public function frontline()
    {
        return app('Frontline')->where('status', '1')->orderBy('order_level', 'ASC')->get();
    }

    public function carousel()
    {
        $array = app('CarouselGroupDetails');

        if (!is_null(request()->filter_carousel_group)) 
        {
            $array = $array->where('group_id', request()->filter_carousel_group);
        }

        if (!is_null(request()->filter_carousel_status)) 
        {
            $array = $array->where('status', request()->filter_carousel_status);
        }

        if (!is_null(request()->filter_carousel_search)) 
        {
            $array = $array->where('carousel_text', 'LIKE' , request()->filter_carousel_search.'%')
                           ->orWhere('carousel_link', 'LIKE' , request()->filter_carousel_search.'%')
                           ->orWhere('carousel_btn_text', 'LIKE' , request()->filter_carousel_search.'%');
        }

        return $array->orderBy('carousel_id','desc')->orderBy('created_date','desc');
    }

    public function center($id = null)
    {
        $center = app('CenterBar');

        if (request()->has('status')) 
        {
            $center = $center->where('status', request()->status);
        }

        if (request()->has('orderby')) 
        {
            $center = $center->orderby('order_level', request()->orderby);
        }

        if (!is_null($id)) 
        {
            $center = $center->where('center_id', $id)->first();
        } 
            else 
        {
            $center = $center->get();
        }
        
        return $center;
    }

    public function center_details($id = null)
    {
        $collection = app('CenterBarDetails');

        if (request()->has('status')) 
        {
            $collection = $collection->where('status', request()->status);
        }

        if (request()->has('orderby')) 
        {
            $collection = $collection->orderby('order_level', request()->orderby);
        }

        if (!is_null($id)) 
        {
            $collection = $collection->where('detail_id', $id);
        } 
        
        return $collection->get();
    }

    public function center_image_video($id = null)
    {
        $center = app('CenterBarVidImg');

        if (request()->has('status')) 
        {
            $center = $center->where('status', request()->status);
        }

        if (request()->has('orderby')) 
        {
            $center = $center->orderby('order_level', request()->orderby);
        }

        if (!is_null($id)) 
        {
            $center = $center->where('content_id', $id)->first();
        } 
            else 
        {
            $center = $center->get();
        }
        
        return $center;
    }

    public function getWebFooter($row)
    {
        $footer = app('Footer')->where('footer_row', $row)->where('status', '1');

        $footer = $footer->orderBy('order_level', 'asc')->has('subClass')->with('subClass');

        return $footer->get();
    }

    public function active_module()
    {
        $modules = app('SystemModule')->where('status','1')->orderBy('order_level','asc')->get();
    }

    public function active_news_and_events()
    {
        $newsevents = app('CenterBar')->where('center_id','1')->where('status','1');

        $newsevents = $newsevents->orderBy('order_level', 'ASC')->has('subClass')->with('subClass')->first();

        return $newsevents;
    }

    public function active_featured_articles()
    {
        $photos = app('CenterBar')->where('center_id','2')->where('status','1');

        $photos = $photos->orderBy('order_level', 'ASC')->has('subClass')->with('subClass')->first();

        return $photos;
    }

    public function active_photo_releases()
    {
        $photos = app('CenterBar')->where('center_id','3')->where('status','1');

        $photos = $photos->orderBy('order_level', 'ASC')->has('subClassVidImg')->with('subClassVidImg')->first();

        return $photos;
    }

    public function active_featured_videos()
    {
        $photos = app('CenterBar')->where('center_id','4')->where('status','1');

        $photos = $photos->orderBy('order_level', 'ASC')->has('subClassVidImg')->with('subClassVidImg')->first();

        return $photos;
    }
}
