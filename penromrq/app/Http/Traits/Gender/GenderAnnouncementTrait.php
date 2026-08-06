<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Traits\Gender\GenderPageSetupTrait;

trait GenderAnnouncementTrait
{

	public function gender_announcement_rules()
	{
		return [
			'description' => 'required|min:10|max:500',
			'full_description' => 'required|min:10',
		];
	}

	public function gender_create_announcement($method, $id = null, $request)
	{

		$rules = $this->gender_announcement_rules();

		$validate = $this->validate($request, $rules);

		$toPanelPosts = [
			'post_subject' => $request->description,
			'post_content' => $request->full_description,
			'post_link' => $request->description_link,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetailsPosts')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$PanelPostsId = app('GenderPanelDetailsPosts')->insertGetId($toPanelPosts);

		$toPanel = [
			'panel_id' => $request->panel_id,
			'detail_code' => 'ANN',
			'detail_type_id' => '4',
			'detail_content_id' => $PanelPostsId,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetails')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		app('GenderPanelDetails')->insert($toPanel);

		Session::flash('success','Announcement successfully created.');
		return back();
	
	}

	public function gender_edit_announcement($method, $id = null, $request)
	{
		
		$PanelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id))->first();

		if(count($PanelDetails) > 0) {

			$PanelDetailsContent = $this->gender_panel_detail_content($PanelDetails)->first();

			$GenderPanel = $PanelDetailsContent->panelInfo;

			return $this->myViewMethodLoader($method)
		                ->with('PanelPosts', $PanelDetailsContent)
		                ->with('GenderPanel', $GenderPanel)
		                ->with('webdata', $this);

		} else {
		    Session::flash('failed','Activty data do not exists.');
		    return back();
		}

	}

	public function gender_update_announcement($method, $id = null, $request)
	{

		$rules = $this->gender_announcement_rules();

		$validate = $this->validate($request, $rules);

		$panelPosts = app('GenderPanelDetailsPosts')->where('post_id', Crypt::decrypt($id));

		$toPanelPosts = [
			'post_subject' => $request->description,
			'post_content' => $request->full_description,
			'post_link' => $request->description_link,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if(count($panelPosts->first()) > 0) {

			$panelPosts->update($toPanelPosts);

			$toPanel = [
				'panel_id' => $request->panel_id,
				'updated_by' => $this->thisUser()->users_id,
				'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			];

			app('GenderPanelDetails')
				->where('detail_id', Crypt::decrypt($request->panel_detail_id))
				->update($toPanel);

			Session::flash('success','Announcement successfully updated.');
			return back();

		} else {

			Session::flash('failed','Something went wrong. Please try again!');
			return back();
			
		}

	}

	public function gender_toggle_announcement_tab($method, $id = null, $request) 
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id',Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['post_tab' => $request->status ]);
		}

	}

	public function gender_toggle_announcement($method, $id = null, $request) 
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id',Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['status' => $request->status ]);
			$panelDetails->update(['status' => $request->status ]);
		}

	}

	public function gender_delete_announcement($method, $id = null, $request)
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id',Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->delete();
			$panelDetails->delete();
		}

		Session::flash('success','Announcement successfully deleted.');
		return back();

	}

}