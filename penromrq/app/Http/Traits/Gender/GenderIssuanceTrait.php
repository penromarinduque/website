<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Requests\CreateActivity;
use App\Http\Traits\Gender\GenderPageSetupTrait;

trait GenderIssuanceTrait
{

	public function gender_issuance_rules()
	{
		return [
			'number' => 'required|min:6|max:150',
			'description' => 'required|min:10|max:150',
		];
	}

	public function gender_create_legal_issuance($method, $id = null, $request)
	{

		$rules = $this->gender_issuance_rules();

		$validate = $this->validate($request, $rules);

		$toPanelLinks = [
			'link_code' => $request->number,
			'link_description' => $request->description,
			'link_path' => $request->link,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetailsLinks')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$PanelLinksId = app('GenderPanelDetailsLinks')->insertGetId($toPanelLinks);

		$toPanel = [
			'detail_code' => 'LEG',
			'panel_id' => $request->panel_id,
			'detail_type_id' => Crypt::decrypt($id),
			'detail_content_id' => $PanelLinksId,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetails')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		app('GenderPanelDetails')->insert($toPanel);

		Session::flash('success','New Issuance successfully created.');
		return back();
	
	}

	public function gender_edit_issuance($method, $id = null, $request)
	{

		$PanelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id))->first();

		if(count($PanelDetails) > 0) {

			$PanelDetailsContent = $this->gender_panel_detail_content($PanelDetails)->first();

			$GenderPanel = $PanelDetailsContent->panelInfo;

			return $this->myViewMethodLoader($method)
		                ->with('PanelLinks', $PanelDetailsContent)
		                ->with('GenderPanel', $GenderPanel)
		                ->with('webdata', $this);

		} else {
		    Session::flash('failed','Issuance data do not exists.');
		    return back();
		}
	
	}

	public function gender_update_legal_issuance($method, $id = null, $request)
	{

		$rules = $this->gender_issuance_rules();

		$validate = $this->validate($request, $rules);

		$panelLinks = app('GenderPanelDetailsLinks')->where('link_id', Crypt::decrypt($id));

		$toPanelLinks = [
			'link_code' => $request->number,
			'link_description' => $request->description,
			'link_path' => $request->link,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if(count($panelLinks->first()) > 0) {

			$panelLinks->update($toPanelLinks);

			Session::flash('success','Issuance successfully updated.');
			return back();

		} else {

			Session::flash('failed','Something went wrong. Please try again!');
			return back();
			
		}

	}

	public function gender_toggle_issuance_tab($method, $id = null, $request)
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['link_tab' => $request->status ]);
		}
	}

	public function gender_toggle_issuance($method, $id = null, $request) 
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['status' => $request->status ]);
			$panelDetails->update(['status' => $request->status ]);
		}

	}

	public function gender_delete_issuance($method, $id = null, $request)
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->delete();
			$panelDetails->delete();
		}

		Session::flash('success','Issuance successfully deleted.');
		return back();

	}

}