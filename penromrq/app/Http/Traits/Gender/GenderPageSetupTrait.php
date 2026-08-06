<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderPageSetupTrait
{

	public function gender_retrieve_all_panel_details($code)
	{
		$panelDetails = app('GenderPanelDetails')
							->where('panel_id', $code)
							->orderBy('order_level','desc')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_all_activity()
	{
		$panelDetails = app('GenderPanelDetails')
							->where('detail_code','ACT')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_all_announcement()
	{
		$panelDetails = app('GenderPanelDetails')
							->where('detail_code','ANN')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_all_calendar()
	{
		$panelDetails = app('GenderPanelDetails')
							->where('detail_code','CAL')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_all_photos()
	{
		$panelDetails = app('GenderPanelDetails')
							->where('detail_code','PHO')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_all_videos()
	{
		$panelDetails = app('GenderPanelDetails')
							->where('detail_code','VID')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_all_legal_issuance()
	{
		$panelDetails = app('GenderPanelDetails')
							->where('detail_code','LEG')
							->orderBy('created_date','desc')
							->paginate(10);

		return $this->gender_panel_details_content($panelDetails);
	}

	public function gender_retrieve_panel_group($detialId = null)
	{
		$GenderPanel = app('GenderPanel')->where('status','1');

		$GenderPanel = (!is_null($detialId)) ? $GenderPanel->where('detail_id', $detialId) :  $GenderPanel ;

		return $GenderPanel->get();

	}

}