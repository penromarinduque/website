<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Requests\CreateActivity;
use App\Http\Traits\Gender\GenderPageSetupTrait;

trait GenderFeaturedVideosTrait	
{

	public function gender_featured_videos_rules()
	{
		return [
			'link' => 'required',
			'description' => 'required|min:10|max:150',
		];
	}

	public function gender_create_featured_videos($method, $id = null, $request)
	{

		$getYouTubeThumbnail = $this->youtube_video_thumbnail_api($request->link);

		$rules = $this->gender_featured_videos_rules();

		$validate = $this->validate($request, $rules);

		$toPanelFiles = [
			'file_type' => 'VID',
			'file_link' => $request->link,
			'file_name' => $request->description,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetailsFiles')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if(!$getYouTubeThumbnail['status']) {

			Session::flash('failed','Something went wrong! Invalid Youtube URL.');
			return back();

		} else {

			if(Storage::disk('gender')->exists($getYouTubeThumbnail['data'])) 
			{
				$toPanelFiles = Arr::add($toPanelFiles,'file_path', $getYouTubeThumbnail['data']);
			}

		}
	
		$PanelFilesId = app('GenderPanelDetailsFiles')->insertGetId($toPanelFiles);

		$toPanel = [
			'detail_code' => 'VID',
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

	public function gender_edit_featured_videos($method, $id = null, $request)
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
		    Session::flash('failed','Photo Release data do not exists.');
		    return back();
		}
	
	}

	public function gender_update_featured_videos($method, $id = null, $request)
	{

		$rules = $this->gender_featured_videos_rules();

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

				$path = Storage::disk('gender')->putFile('photo-releases',$request->file('photo'));

				$toPanelFiles = Arr::add($toPanelFiles,'file_path',$path);

			}

			$panelFiles->update($toPanelFiles);

			Session::flash('success','Photo Release successfully updated.');
			return back();

		} else {

			Session::flash('failed','Something went wrong. Please try again!');
			return back();
			
		}

	}

	public function gender_toggle_featured_videos_tab($method, $id = null, $request)
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['file_tab' => $request->status ]);
		}
	}

	public function gender_toggle_featured_videos($method, $id = null, $request) 
	{
		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));
		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['status' => $request->status ]);
			$panelDetails->update(['status' => $request->status ]);
		}
	}

	public function gender_delete_featured_videos($method, $id = null, $request)
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id', Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->delete();
			$panelDetails->delete();
		}

		Session::flash('success','Photo Release successfully deleted.');
		return back();

	}

}