<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderDashboardTrait
{

	protected function gender_dashboard($window)
	{
		return $this->myViewLoader($window);
	}

	protected function gender_page_setup($window)
	{
		$navdetails = app('GenderNavBarDetails')->where('detail_type','0')->where('detail_editable','1')->orderBy('created_date','asc')->get();

		return $this->myViewLoader($window)->with('navdetails', $navdetails);	
	}

	protected function gender_carousel_group($window)
	{
		$carousel_group = app('GenderCarouselGroup')->orderBy('order_level','desc')->get();

		return $this->myViewLoader($window)->with('carousel_group', $carousel_group);
	}

	protected function gender_carousel_group_details($window)
	{
		$carousel_group_details = app('GenderCarouselGrpDetails')->orderBy('order_level','desc')->get();

		return $this->myViewLoader($window)->with('carousel_group_details', $carousel_group_details);
	}

	protected function gender_navigation_group($window)
	{
		return $this->myViewLoader($window);
	}

	protected function gender_navigation_group_details($window)
	{
		return $this->myViewLoader($window);
	}

	protected function gender_activities($window)
	{
		return $this->myViewLoader($window);
	}

	protected function gender_announcement($window)
	{
		return $this->myViewLoader($window);
	}

	protected function gender_calendar($window)
	{
		return $this->myViewLoader($window);
	}	

	protected function gender_photo_release($window)
	{
		return $this->myViewLoader($window);
	}

	protected function gender_feature_video($window)
	{
		return $this->myViewLoader($window);
	}

}