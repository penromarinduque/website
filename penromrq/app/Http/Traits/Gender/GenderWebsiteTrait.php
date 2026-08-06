<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderWebsiteTrait
{
	
	protected function toIndex($method, $id = null, $request)
	{

		$Carousel = $this->gender_carousel();
		$PostsDetails = $this->gender_panel_details_by_code('ACT',3);
		$Announcements = $this->gender_announcement_posts();
		$Calendar = $this->gender_calendar_posts();
		$PhotoReleases = $this->gender_photo_releases_posts();
		$FeatureVideos = $this->gender_featured_videos_posts();
		$Panels = $this->gender_page_panel($method->detail_id, 10);

		return view($method->detail_blade)
					->with('Panels', $Panels)
					->with('Carousel', $Carousel)
					->with('PostsDetails', $PostsDetails)
					->with('Announcements', $Announcements)
					->with('Calendar', $Calendar)
					->with('PhotoReleases', $PhotoReleases)
					->with('FeatureVideos', $FeatureVideos);

	}

	protected function gender_page_panel($detail, $page = 5)
	{

		$GenderPanel = app('GenderPanel')
							->where('detail_id', $detail)
							->orderBy('created_date','desc')
							->where('status', '1')
							->get();

		return $this->gender_page_panel_with_details($GenderPanel, $page);

	}

	protected function gender_page_panel_with_details($GenderPanel, $page)
	{

		foreach ($GenderPanel as $key => $value) {

			$PanelDetails = $this->gender_panel_details_by_id($value->panel_id, $page);

			Arr::add($value, 'panel_details', $this->gender_panel_details_content($PanelDetails) );

		}

		return $GenderPanel;

	}

	protected function gender_panel_details_by_id($panel, $page = 5)
	{

		return app('GenderPanelDetails')->where('status','1')->where('panel_id', $panel)
					->orderBy('order_level','desc')
					->orderBy('created_date','desc')
					->paginate($page);

	}

	public function gender_panel_details_content($PanelDetails)
	{

		foreach ($PanelDetails as $key => $value) {
			if($value->detail_type_id == '1') {
				$DetailsContent = app('GenderPanelDetailsFiles')->where('file_id',$value->detail_content_id)->first();
				Arr::add($value,'files', $DetailsContent);
			}

			if($value->detail_type_id == '2') {
				$DetailsContent = app('GenderPanelDetailsFrames')->where('frame_id',$value->detail_content_id)->first();
				Arr::add($value,'frames', $DetailsContent);
			}

			if($value->detail_type_id == '3') {
				$DetailsContent = app('GenderPanelDetailsLinks')->where('link_id',$value->detail_content_id)->first();
				Arr::add($value,'links', $DetailsContent);
			}

			if($value->detail_type_id == '4') {
				$DetailsContent = app('GenderPanelDetailsPosts')->where('post_id',$value->detail_content_id)->first();
				Arr::add($value,'posts', $DetailsContent);
			}
		}

		return $PanelDetails;

	}

	protected function gender_carousel_data()
	{
		return app('GenderCarouselGrpDetails')
					->orderBy('order_level','desc')
					->where('status','1')
					->get();
	}

	public function gender_posts_per_year($year)
	{

		return app('GenderPostsDetails')
					->where('status','1')
					->orderBy('order_level','desc')
					->orderBy('created_date','desc')
					->where('created_date','like','%'.$year.'%')
					->paginate(10,['*'],'activities')
					->withPath(request()->root().'/gad/activities/all-activities/'.$year);

	}

	protected function gender_announcement_posts()
	{

		$AnnouncementPanel = app('GenderPanelDetails')
							->where('status','1')
							->where('detail_code','ANN')
							->where('detail_type_id','4')
							->orderBy('order_level','desc')
							->orderBy('created_date','desc')
							->paginate(3,['*'],'announcement')
							->withPath(request()->root().'/gad/activities/announcement/'.str_random(10));

		foreach ($AnnouncementPanel as $key => $value) {
			
			$Announcements = app('GenderPanelDetailsPosts')
								->where('post_id', $value->detail_content_id)
								->orderBy('created_date','desc')
								->first();

			Arr::add($value, 'announcement', $Announcements);

		}

		return $AnnouncementPanel;

	}	

	protected function gender_calendar_posts()
	{

		$CalendarPanel = app('GenderPanelDetails')
							->where('status','1')
							->where('detail_code','CAL')
							->where('detail_type_id','1')
							->orderBy('order_level','desc')
							->orderBy('created_date','desc')
							->paginate(5,['*'],'calendar')
							->withPath(request()->root().'/gad/activities/calendar/'.str_random(10));

		foreach ($CalendarPanel as $key => $value) {
			$Calendar = app('GenderPanelDetailsFiles')->where('file_id', $value->detail_content_id)->first();
			Arr::add($value, 'calendar', $Calendar);
		}

		return $CalendarPanel;

	}

	protected function gender_photo_releases_posts()
	{

		$PhotoReleases = app('GenderPanelDetails')
							->where('status','1')
							->where('detail_code','PHO')
							->where('detail_type_id','1')
							->orderBy('order_level','desc')
							->orderBy('created_date','desc')
							->paginate(10,['*'],'photo-releases')
							->withPath(request()->root().'/gad/activities/photo-releases/'.str_random(10));

		foreach ($PhotoReleases as $key => $value) {
			$Photos = app('GenderPanelDetailsFiles')->where('file_id', $value->detail_content_id)->first();
			Arr::add($value, 'photos', $Photos);
		}

		return $PhotoReleases;

	}

	protected function gender_featured_videos_posts()
	{

		$FeaturedVideos = app('GenderPanelDetails')
							->where('status','1')
							->where('detail_code','VID')
							->where('detail_type_id','1')
							->orderBy('order_level','desc')
							->orderBy('created_date','desc')
							->paginate(10,['*'],'featured-videos')
							->withPath(request()->root().'/gad/activities/featured-videos/'.str_random(10));

		foreach ($FeaturedVideos as $key => $value) {
			$Videos = app('GenderPanelDetailsFiles')->where('file_id', $value->detail_content_id)->first();
			Arr::add($value, 'videos', $Videos);
		}

		return $FeaturedVideos;

	}

	protected function gender_panel_details_by_code($code = 'DEF', $page = 5)
	{

		$PanelDetails = app('GenderPanelDetails')
							->where('status','1')
							->where('detail_code', $code)
							->orderBy('order_level','desc')
							->orderBy('created_date','desc')	
							->paginate($page);

		return $this->gender_panel_details_content($PanelDetails);

	}

	protected function gender_activity_detail($method, $id = null, $request)
	{

		$PostsDetails = app('GenderPanelDetailsPosts')
							->where('post_id', Crypt::decrypt($id))
							->where('status','1')
							->first();

		return (count($PostsDetails) > 0) ? view($method->method_blade)->with('detail', $PostsDetails) : $this->error404() ;

	}

	protected function gender_activity_detail_paginate($method, $id = null, $request)
	{

		$PostsDetails = $this->gender_panel_details_by_code('ACT', 3);

		return view($method->method_blade)->with('PostsDetails', $PostsDetails);
		
	}

	protected function gender_all_detail_activities($method, $id = null, $request)
	{

		$Posts = $this->gender_panel_details_by_code('ACT' ,10);

		return view($method->method_blade)->with('Posts', $Posts);
		
	}

	protected function gender_announcement_detail_paginate($method, $id = null, $request)
	{

		$Announcements = $this->gender_announcement_posts();

		return view($method->method_blade)->with('Announcements', $Announcements);

	}

	protected function gender_calendar_detail_paginate($method, $id = null, $request)
	{

		$Calendar = $this->gender_calendar_posts();

		return view($method->method_blade)->with('Calendar', $Calendar);

	}

	protected function gender_home_activities($method, $id = null, $request)
	{

		$PostsDetails = $this->gender_panel_details_by_code('ACT',3);

		return view($method->method_blade)->with('PostsDetails', $PostsDetails);

	}

}