<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
use App\Http\Traits\Gender\GenderPageSetupTrait;

trait GenderActivityTrait
{

	public function gender_activity_rules()
	{
	    return [
	        'panel_id' => 'required',
	        'description' => 'required|min:30',
	        'published_by' => 'required|min:6',
	        'published_date' => 'required|date',
	        'full_description' => 'required|min:150',
	        'image1' => 'mimes:'.$this->validatefile('I'),
	    ];
	}

	public function gender_create_activity($method, $id = null, $request)
	{

		$rules = $this->gender_activity_rules();

		$validate = $this->validate($request, $rules);

		$toPanelPosts = [
			'post_subject' => $request->description,
			'post_content' => $request->full_description,
			'published_by' => $request->published_by,
			'published_date' => $request->published_date,
			'post_link' => $request->description_link,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetailsPosts')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if($request->hasFile('image1')) 
		{

			$path = Storage::disk('gender')->putFile('activity', $request->file('image1'));

			$toPanelPosts = Arr::add($toPanelPosts,'post_image_path', $path);

		}

		$PanelPostsId = app('GenderPanelDetailsPosts')->insertGetId($toPanelPosts);

		$toPanel = [
			'panel_id' => $request->panel_id,
			'detail_code' => 'ACT',
			'detail_type_id' => '4',
			'detail_content_id' => $PanelPostsId,
			'order_level' => (new CommonService)->orderLevel(app('GenderPanelDetails')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		app('GenderPanelDetails')->insert($toPanel);

		Session::flash('success','Activity successfully created.');
		return back();
	
	}

	public function gender_edit_activity($method, $id = null, $request)
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

	public function gender_update_activity($method, $id = null, $request)
	{

		$rules = $this->gender_activity_rules();

		$validate = $this->validate($request, $rules);

		$panelPosts = app('GenderPanelDetailsPosts')->where('post_id', Crypt::decrypt($id));

		$toPanelPosts = [
			'post_subject' => $request->description,
			'post_content' => $request->full_description,
			'published_by' => $request->published_by,
			'published_date' => $request->published_date,
			'post_link' => $request->description_link,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if(count($panelPosts->first()) > 0) {

			if($request->hasFile('image1')) {

				Storage::disk('gender')->delete($panelPosts->first()->post_image_path);

				$path = Storage::disk('gender')->putFile('activity', $request->file('image1'));

				$toPanelPosts = Arr::add($toPanelPosts,'post_image_path', $path);

			}

			$panelPosts->update($toPanelPosts);

			$toPanel = [
				'panel_id' => $request->panel_id,
				'updated_by' => $this->thisUser()->users_id,
				'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			];

			app('GenderPanelDetails')
				->where('detail_id', Crypt::decrypt($request->panel_detail_id))
				->update($toPanel);

			Session::flash('success','Activity successfully updated.');
			return back();

		} else {

			Session::flash('failed','Something went wrong. Please try again!');
			return back();
			
		}

	}

	public function gender_toggle_activity($method, $id = null, $request) 
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id',Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->update(['status' => $request->status ]);
			$panelDetails->update(['status' => $request->status ]);
		}

	}

	public function gender_delete_activity($method, $id = null, $request)
	{

		$panelDetails = app('GenderPanelDetails')->where('detail_id',Crypt::decrypt($id));

		if(count($panelDetails->first()) > 0) {
			$panelDetailsContent = $this->gender_panel_detail_content($panelDetails->first());
			$panelDetailsContent->delete();
			$panelDetails->delete();
		}

		Session::flash('success','Activity successfully deleted.');
		return back();

	}

}