<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Requests\CreateActivity;
use App\Http\Traits\Gender\GenderPageSetupTrait;

trait GenderCalendarTrait	
{

	public function gender_calendar_rules()
	{
		return [
			// 'photo' => 'mimes:' . $this->validatefile('I'),
			'title' => 'required|min:10|max:150',
			'description' => 'required|min:10|max:500',
		];
	}

	public function gender_create_calendar($method, $id = null, $request)
	{

		$rules = $this->gender_calendar_rules();

		$validate = $this->validate($request, $rules);

		$toPanelPosts = [
			'post_subject' => $request->title,
			'post_content' => $request->description,
			'post_link' => $request->link,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetailsPosts')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$PanelPostsId = app('GenderPanelDetailsPosts')->insertGetId($toPanelPosts);

		$toPanel = [
			'panel_id' => $request->panel_id,
			'detail_code' => 'CAL',
			'detail_type_id' => decrypt($id),
			'detail_content_id' => $PanelPostsId,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetails')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		app('GenderPanelDetails')->insert($toPanel);

		Session::flash('success','New Calendar of event successfully created.');
		return back();
	
	}

	public function gender_edit_calendar($method, $id = null, $request)
	{

		$PanelDetails = app('GenderPanelDetails')->where('detail_id', decrypt($id))->first();

		if(count($PanelDetails) > 0) {

			$PanelDetailsContent = $this->gender_panel_detail_content($PanelDetails)->first();

			$GenderPanel = $PanelDetailsContent->panelInfo;

			return $this->myViewMethodLoader($method)
		                ->with('PanelFiles', $PanelDetailsContent)
		                ->with('GenderPanel', $GenderPanel)
		                ->with('webdata', $this);

		} else {
		    Session::flash('failed','Calendar data do not exists.');
		    return back();
		}
	
	}

	public function gender_update_calendar($method, $id = null, $request)
	{

		$rules = $this->gender_calendar_rules();

		$validate = $this->validate($request, $rules);

		$panelPosts = app('GenderPanelDetailsPosts')->where('post_id', decrypt($id));

		$toPanelPosts = [
			'post_subject' => $request->title,
			'post_content' => $request->description,
			'post_link' => $request->link,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if(count($panelPosts->first()) > 0) {

			$panelPosts->update($toPanelPosts);

			Session::flash('success','Calendar successfully updated.');
			return back();

		} else {

			Session::flash('failed','Something went wrong. Please try again!');
			return back();
			
		}

	}

	public function gender_toggle_calendar_tab($method, $id = null, $request)
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['file_tab' => $request->status ]);
		}
	}

	public function gender_toggle_calendar($method, $id = null, $request) 
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['status' => $request->status ]);
			$panelDetails->update(['status' => $request->status ]);
		}
	}

	public function gender_delete_calendar($method, $id = null, $request)
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id', decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->delete();
			$panelDetails->delete();
		}

		Session::flash('success','Calendar successfully deleted.');
		return back();

	}

}