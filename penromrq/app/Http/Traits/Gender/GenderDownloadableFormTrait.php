<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Traits\Gender\GenderPageSetupTrait;

trait GenderDownloadableFormTrait	
{

	public function gender_downloadable_form_rules()
	{
		return [
			'photo' => 'mimes:' . $this->validatefile('I'),
			'description' => 'required|min:10|max:150',
		];
	}

	public function gender_create_downloadable_form($method, $id = null, $request)
	{

		$rules = $this->gender_downloadable_form_rules();

		$validate = $this->validate($request, $rules);

		$toPanelFiles = [
			'file_type' => 'IMG',
			'file_link' => $request->link,
			'file_name' => $request->description,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetailsFiles')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if($request->hasFile('photo')) {

			$path = Storage::disk('gender')->putFile('downloadable-form', $request->file('photo'));

			$toPanelFiles = Arr::add($toPanelFiles,'file_path',$path);

		}

		$PanelFilesId = app('GenderPanelDetailsFiles')->insertGetId($toPanelFiles);

		$toPanel = [
			'detail_code' => 'DLF',
			'panel_id' => $request->panel_id,
			'detail_type_id' => Crypt::decrypt($id),
			'detail_content_id' => $PanelFilesId,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetails')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		app('GenderPanelDetails')->insert($toPanel);

		Session::flash('success','New Photo Release successfully created.');
		return back();
	
	}

	public function gender_edit_downloadable_form($method, $id = null, $request)
	{

		$PanelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id))->first();

		if(count($PanelDetails) > 0) {

			$PanelDetailsContent = $this->gender_panel_detail_content($PanelDetails)->first();

			$GenderPanel = $PanelDetailsContent->panelInfo;

			return $this->myViewMethodLoader($method)
		                ->with('PanelFiles', $PanelDetailsContent)
		                ->with('GenderPanel', $GenderPanel)
		                ->with('webdata', $this);

		} else {
		    Session::flash('failed','Downloadable Form data do not exists.');
		    return back();
		}
	
	}

	public function gender_update_downloadable_form($method, $id = null, $request)
	{

		$rules = $this->gender_downloadable_form_rules();

		$validate = $this->validate($request, $rules);

		$panelFiles = app('GenderPanelDetailsFiles')->where('file_id', Crypt::decrypt($id));

		$toPanelFiles = [
			'file_name' => $request->description,
			'file_link' => $request->link,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if(count($panelFiles->first()) > 0) {

			if($request->hasFile('photo')) {

				Storage::disk('gender')->delete($panelFiles->first()->file_path);

				$path = Storage::disk('gender')->putFile('downloadable-form', $request->file('photo'));

				$toPanelFiles = Arr::add($toPanelFiles,'file_path',$path);

			}

			$panelFiles->update($toPanelFiles);

			Session::flash('success','Downloadable Form successfully updated.');
			return back();

		} else {

			Session::flash('failed','Something went wrong. Please try again!');
			return back();
			
		}

	}

	public function gender_toggle_downloadable_form_tab($method, $id = null, $request)
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['file_tab' => $request->status ]);
		}
	}

	public function gender_toggle_downloadable_form($method, $id = null, $request) 
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['status' => $request->status ]);
			$panelDetails->update(['status' => $request->status ]);
		}
	}

	public function gender_delete_downloadable_form($method, $id = null, $request)
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->delete();
			$panelDetails->delete();
		}

		Session::flash('success','Downloadable Form successfully deleted.');
		return back();

	}

}