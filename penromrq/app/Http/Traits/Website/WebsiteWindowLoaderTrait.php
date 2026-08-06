<?php

namespace App\Http\Traits\Website;

use Session;
use Illuminate\Http\Request;

trait WebsiteWindowLoaderTrait 
{

	public function website_admin_dashboard($window)
	{
		$cnt_news_and_event = $this->website_count_center_bar_details(1);
		$cnt_feature_articl = $this->website_count_center_bar_details(2);
		$cnt_feature_photos = $this->website_count_center_bar_details(3);
		$cnt_feature_videos = $this->website_count_center_bar_details(4);
		
	    return $this->myViewLoader($window)
	    			->with('cnt_feature_photo', $cnt_feature_photos)
	    			->with('cnt_feature_video', $cnt_feature_videos)
	    			->with('cnt_news_and_events', $cnt_news_and_event)
	    			->with('cnt_feature_article', $cnt_feature_articl);
	}

	public function website_carousel_setup($window)
	{
		$carousel = $this->carousel()->get();

		$carouselGroup = app('CarouselGroup')->where('status','1')->get();

		return $this->myViewLoader($window)
					->with('carouselGroup', $carouselGroup)
					->with('carousel', $carousel);
	}

	public function website_center_panel_setup($window)
	{
	    $center_panel_data = $this->center();

	    return $this->myViewLoader($window)
	                ->with('center_panel_data', $center_panel_data);
	}

	public function website_agency_footer_setup($window)
	{
	    return $this->myViewLoader($window)
	                ->with('footer', $this->website_footer_data('A'));
	}

	public function website_standard_footer_setup($window)
	{
	    return $this->myViewLoader($window)
	                ->with('footer', $this->website_footer_data('S'));
	}

	public function website_frontline_setup($window)
	{
	    return $this->myViewLoader($window)
	                ->with('frontline', $this->website_frontline_data());
	}

	public function website_master_head_setup($window)
	{
		return $this->myViewLoader($window)
					->with('masterhead', $this->masterhead());
	}

	public function website_top_navigation_setup($window)
	{
		return $this->myViewLoader($window)
					->with('navheader1', $this->getNavHeader(null,1));
	}

	public function website_bottom_navigation_setup($window)
	{
		return $this->myViewLoader($window)
					->with('navheader',$this->getNavHeader(null,2))
                    ->with('path', $window->menu_path)
                    ->with('module', $this->usersActiveModule());
	}

	public function website_page_setup($window)
	{
		$menu0 = $this->getNavHeader();
		$menu1 = $this->getNavHeader(null, 1);
		$menu2 = $this->getNavHeader(null, 2);
		$menu3 = $this->getNavHeader(null, 3);

		return $this->myViewLoader($window)
					->with('menu0', $menu0)
					->with('menu1', $menu1)
					->with('menu2', $menu2)
					->with('menu3', $menu3);
	}

	public function website_side_panel_setup($window)
	{
	    return $this->myViewLoader($window)
	                ->with('navheader1',$this->getNavHeader(null,1))
	                ->with('navheader2',$this->getNavHeader(null,2))
	                ->with('navheader3',$this->getNavHeader(null,3))
	                ->with('left_panel', $this->website_side_panel_data('L'))
	                ->with('right_panel', $this->website_side_panel_data('R'));
	}

	public function website_special_page_setup($window)
	{
		return $this->myViewLoader($window)
		            ->with('navheader3', $this->getNavHeader(null, 3));
	}
}