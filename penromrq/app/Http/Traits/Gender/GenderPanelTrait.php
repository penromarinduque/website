<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderPanelTrait
{

	public function gender_retrieve_panel($method, $id = null, $request)
	{	
	
		$GenderNavBarDetails = app('GenderNavBarDetails')->where('detail_id',decrypt($id))->first();

	 	if(count($GenderNavBarDetails) > 0) {
	 
	 		$GenderPanel = app('GenderPanel')
	 							->where('detail_id', $GenderNavBarDetails->detail_id)
	 							->orderBy('order_level','desc')
	 							->get();

	 		return $this->myViewMethodLoader($method)
							  	->with('GenderNavBarDetails', $GenderNavBarDetails)
							  	->with('GenderPanel', $GenderPanel);

	 	} else {
	 		Session::flash('failed','Something went wrong, Please try again');
	 		return back();
	 	}
		
	}

	public function gender_edit_panel($method, $id = null, $request)
	{

		$GenderPanel = app('GenderPanel')->where('panel_id', decrypt($id))->first();

	 	if(count($GenderPanel) > 0) {
	 
	 		return $this->myViewMethodLoader($method)
							  	->with('GenderNavBarDetails', $GenderPanel->navBarDetailsInfo)
							  	->with('GenderPanel', $GenderPanel);

	 	} else {
	 		Session::flash('failed','Something went wrong, Please try again');
	 		return back();
	 	}

	}

	public function gender_update_panel($method, $id = null, $request)
	{
		$this->validate($request,[
			'description' => 'required',
		]);

		$GenderPanel = app('GenderPanel')->find(decrypt($id));

		$GenderPanel->panel_name = $request->description;
		$GenderPanel->updated_by = $this->thisUser()->users_id;	
		$GenderPanel->updated_date = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

		if($GenderPanel->save()) {
			Session::flash('success','Panel successfully updated');
			return back();
		} else {
			Session::flash('failed','Something went wrong, Please try again');
			return back();
		}
	}
	
	protected function gender_create_panel($method, $id = null, $request)
	{
		
		$this->validate($request,[
			'description' => 'required',
		]);

		$GenderDetail = app('GenderNavBarDetails')->where('detail_id', decrypt($id))->first();

		if(count($GenderDetail) > 0) {
			
			$GenderPanel               = app('GenderPanel');
			$GenderPanel->detail_id    = decrypt($id);
			$GenderPanel->panel_name   = $request->description;
			$GenderPanel->panel_blade  = str_replace('website', 'admin', $GenderDetail->detail_blade);
			$GenderPanel->order_level  = (new CommonService)->orderLevel($GenderPanel);
			$GenderPanel->created_by   = $this->thisUser()->users_id;	
			$GenderPanel->created_date = (new CommonService)->dateTimeToday('Y-m-d h:i:s');

			if($GenderPanel->save()) {
				Session::flash('success','New panel successfully created');
				return back();
			} else {
				Session::flash('failed','Something went wrong, Please try again');
				return back();
			}

		} else {
			Session::flash('failed','Something went wrong, Please try again');
			return back();
		}

	}

	public function gender_delete_panel($method, $id = null, $request)
	{
		
		$GenderPanel = app('GenderPanel');
		$GenderPanelDetails = app('GenderPanelDetails');

		$GenderPanel = $GenderPanel->where('panel_id',decrypt($id));

		$GenderPanelDetails = $GenderPanelDetails->where('panel_id',decrypt($id))->count();

		if($GenderPanelDetails > 0) {

			Session::flash('failed','Cannot delete panel with details or content');
			return back();

		} else {

			$GenderPanel->delete();

			Session::flash('success','Panel successfully deleted');
			return back();
			
		}

	}

	// PANEL DETAILS 
	public function gender_retrieve_panel_details($method, $id = null, $request)
	{

		$GenderPanel = app('GenderPanel')
							->where('status','1')
							->where('panel_id', decrypt($id))
							->first();
		
		$GenderPanelDetails = app('GenderPanelDetails')->where('panel_id', decrypt($id))->get();

	 	if(count($GenderPanel) > 0) {
	 		
	 		return view($GenderPanel->panel_blade)
                        ->with('webdata', $this)
	 		 			->with('GenderPanel', $GenderPanel)
                        ->with('module', $this->usersActiveModule())
	 					->with('GenderPanelDetails', $GenderPanelDetails)

                        ->with('path', $method->systemWindow->menu_path)
	                    ->with('windowName', $method->systemWindow->menu_name)
	                    ->with('windowIcon', $method->systemWindow->menu_icon)
	                    ->with('thisUser', $this->thisUser())
	                    ->with('activeModule', $this->getModulePrefix())
	                    ->with('activeSideBar', $this->getActiveSideBar())
	                    ->with('usersActiveModule', $this->usersActiveModule($this->thisUser()->users_id));

	 	} else {
	 		Session::flash('failed','Something went wrong, Please try again');
	 		return back();
	 	}

	}

}