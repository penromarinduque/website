<?php

namespace App\Http\Traits\Website;

use Crypt;
use Session;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait WebsitePageSetupTrait
{

	public function admin_view_panel_detail_setup($method, $id, $request)
	{

	    $panel = app('Panel')->where('panel_id',decrypt($id))->first();

	    $dashboard = app('PanelDetails')->where('status','1')
	    				->where('panel_dtl_parent_id',decrypt($id))
		    			->orderBy('order_level','asc')
		    			->orderBy('panel_dtl_id','asc')
		    			->orderBy('created_date','asc')
		    			->paginate(10,['*'],'dashboard');

	    $storage = app('PanelDetails')
	    				->where('panel_dtl_parent_id',decrypt($id))
	    				->where('panel_dtl_type','1')
						->has('storage')->with('storage')
	    				->orderBy('created_date','desc')
	    				->orderBy('panel_dtl_id','desc')
	    				->paginate(10,['*'],'storage');

	    $frameset = app('PanelDetails')
	    				->where('panel_dtl_parent_id',decrypt($id))
	    				->where('panel_dtl_type','2')
	    				->has('frameset')->with('frameset')
	    				->orderBy('panel_dtl_id','desc')
	    				->orderBy('created_date','desc')
	    				->paginate(10,['*'],'frameset');

	    $longtext = app('PanelDetails')
	    				->where('panel_dtl_parent_id',decrypt($id))
	    				->where('panel_dtl_type','3')
	    				->has('longtext')->with('longtext')
	    				->orderBy('panel_dtl_id','desc')
	    				->orderBy('created_date','desc')
			    		->paginate(10,['*'],'longtext');

	    $inputtext = app('PanelDetails')
	    				->where('panel_dtl_parent_id',decrypt($id))
	    				->where('panel_dtl_type','4')
	    				->has('inputtext')->with('inputtext')
	    				->orderBy('panel_dtl_id','desc')
	    				->orderBy('created_date','desc')
	    				->paginate(10,['*'],'inputtext');
	
	    return $this->myViewMethodLoader($method)
	    		->with('panel',$panel)
	    		->with('dashboard',$dashboard)
	            ->with('storage',$storage)
	            ->with('frameset',$frameset)
	            ->with('longtext',$longtext)
	            ->with('inputtext',$inputtext);
	}

	public function admin_delete_page_setup_details($method, $id, $request)
	{
		app('PanelDetails')->where('panel_dtl_id',decrypt($id))->delete();

		Session::flash('success','Panel Detail successfully deleted');
		return back();
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// PANEL COLUMN //////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function admin_add_panel_column($method, $id, $request)
	{
		app('Panel')->insert([
			'font_size'    => $request->panel_font_size,
			'panel_nav'    => $request->panel_nav,
			'panel_name'   => $request->panel_name,
			'panel_size'   => $request->panel_sizes,
			'panel_class'  => $request->panel_class,
			'created_by'   => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		Session::flash('success','New window was successfully created');
		return back();
	}

	public function admin_delete_panel_column($method, $id, $request)
	{
		$panelPanelDetails = app('Panel')->where('panel_id',decrypt($id))->panelDetailsInfo()->count();

		if($panelPanelDetails > 0) {
			Session::flash('failed','Unable to delete if has panel details');
		} else {
			if(app('Panel')->where('panel_id',decrypt($id))->delete()) {
				Session::flash('success','Successfully deleted');
			}
		}
		return back();
	}

	public function admin_edit_panel_column($method, $id, $request)
	{
		$updated = app('Panel')->where('panel_id',decrypt($id))->update([
			'font_size'    => $request->panel_font_size,
			'panel_name'   => $request->panel_name,
			'panel_size'   => $request->panel_sizes,
			'panel_class'  => $request->panel_class,
			'updated_by'   => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		Session::flash('success','Panel successfully updated');
		return back();
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// STORAGE ///////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function admin_add_storage_files($method, $id, $request)
	{
	    $this->validate($request, [
	        'file_path' => 'mimes:'.$this->validatefile($request->file_type),
	    ]);

	    $lastInsertId = app('PanelDetailsStorage')->insertGetId([
    		'file_tab'     => $request->file_tab,
    		'file_type'    => $request->file_type,
    		'file_name'    => $request->file_name,
    		'file_link'    => $request->file_link,
    	    'bid_result'   => $request->bid_result,
    	    'closing_date' => $request->close_date,
    		'created_by'   => $this->thisUser()->users_id,
    		'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
    		'file_path'    => $this->profileUpload($request,'file_path'),
	    ]);

	    app('PanelDetails')->insert([
    		'panel_dtl_type'       => 1,
	    	'panel_dtl_parent_id'  => decrypt($request->panel_id),
	    	'panel_dtl_parent_obj' => $lastInsertId,
	    	'created_by'           => $this->thisUser()->users_id,
	    	'created_date'         => (new CommonService)->dateTimeToday('Y-m-d h:i:s')
	    ]);

	    Session::flash('success','Successfully Created');
	    return back();
	}

	public function admin_update_storage_files($method, $id, $request)
	{
		$storage = app('PanelDetailsStorage')->where('storage_id', decrypt($id));

		$array = [
			'file_tab'     => $request->file_tab,
			'file_type'    => $request->file_type,
			'file_name'    => $request->file_name,
			'file_link'    => $request->file_link,
			'bid_result'   => $request->bid_result,
			'closing_date' => $request->close_date,
			'updated_by'   => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];
		
		if($request->hasFile('file_path'))
		{
			$array = Arr::add($array, 'file_path', $this->profileUpload($request,'file_path',$storage->first()->file_path));
		}

		if($storage->update($array)) {
			Session::flash('success','Successfully updated');
		} else {
			Session::flash('failed','No changes to database');
		}

		$this->update_panel_details_order_level($request);
		return back();
	}

	public function admin_toggle_storage_tab($method, $id, $request)
	{
		return app('PanelDetailsStorage')->where('storage_id',decrypt($id))->update([
			'file_tab' => $request->status,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s')
		]);
	}

	public function admin_toggle_storage_status($method, $id, $request)
	{
		return app('PanelDetailsStorage')->where('storage_id',decrypt($id))->update([
			'status' => $request->status,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s')
		]);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// FRAMESET //////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function admin_add_frameset($method, $id, $request)
	{
		$this->validate($request, [
		    'frame_thumbnail' => 'mimes:'.$this->validatefile('I'),
		]);

		$lastInsertId = app('PanelDetailsFrameset')->insertGetId([
			'frame_tab'       => $request->frame_tab,
			'frame_name'      => $request->frame_name,
			'frame_path'      => $request->frame_path,
			'created_by'      => $this->thisUser()->users_id,
			'created_date'    => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			'frame_thumbnail' => $this->profileUpload($request,'frame_thumbnail'),
		]);
		
		app('PanelDetails')->insert([
			'panel_dtl_type'       => 2,
			'panel_dtl_parent_id'  => decrypt($request->panel_id),
			'panel_dtl_parent_obj' => $lastInsertId,
			'created_by'           => $this->thisUser()->users_id,
			'created_date'         => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		Session::flash('success','Successfully Created');
		return back();
	}

	public function admin_update_frameset($method, $id, $request)
	{
		$frameset = app('PanelDetailsFrameset')->where('frame_id',decrypt($id));

		$array = [
			'frame_name'   => $request->frame_name,
			'frame_path'   => $request->frame_path,
			'updated_by'   => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];
	
		if($request->hasFile('frame_thumbnail')) {
			$array = Arr::add($array, 'frame_thumbnail', $this->profileUpload($request,'file_path',$frameset->first()->frame_thumbnail));
		}

		if($frameset->update($array)) {
			Session::flash('success','Successfully updated');
		} else {
			Session::flash('failed','No changes to database');
		}

		$this->update_panel_details_order_level($request);
		return back();
	}

	public function admin_toggle_frameset_tab($method, $id, $request)
	{
		return app('PanelDetailsFrameset')->where('frame_id',decrypt($id))->update([
			'frame_tab' => $request->status,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);
	}

	public function admin_toggle_frameset_status($method, $id, $request)
	{
		return app('PanelDetailsFrameset')->where('frame_id',decrypt($id))->update([
			'status' => $request->status,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// LONG TEXT /////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function admin_add_longtext($method, $id, $request)
	{
		$lastInsertId = app('PanelDetailsLongText')->insertGetId([
			'long_description' => $request->long_description,
			'long_text'        => $request->long_text,
			'created_by'       => $this->thisUser()->users_id,
			'created_date'     => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		app('PanelDetails')->insert([
			'panel_dtl_type'       => 3,
			'panel_dtl_parent_id'  => decrypt($request->panel_id),
			'panel_dtl_parent_obj' => $lastInsertId,
			'created_by'           => $this->thisUser()->users_id,
			'created_date'         => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		Session::flash('success','Successfully Created');
		return back();
	}

	public function admin_update_longtext($method, $id, $request)
	{
		app('PanelDetailsLongText')->where('text_id',decrypt($id))->update([
			'long_text'        => $request->long_text,
			'long_description' => $request->long_description,
			'updated_by'       => $this->thisUser()->users_id,
			'updated_date'     => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		$this->update_panel_details_order_level($request);
		
		Session::flash('success','Successfully updated');
		return back();
	}

	public function admin_toggle_long_text_status($method, $id, $request)
	{
		return app('PanelDetailsLongText')->where('text_id',decrypt($id))->update([
			'status' => $request->status,
			'updated_by' => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// INPUT TEXT ////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function admin_add_inputtext($method, $id, $request)
	{
		$lastInsertId = app('PanelDetailsInputText')->insertGetId([
			'text_description' => $request->text_name,
			'text_link'        => $request->text_path,
			'text_tab'         => $request->text_tab,
			'created_by'       => $this->thisUser()->users_id,
			'created_date'     => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		app('PanelDetails')->insert([
			'panel_dtl_type'       => 4,
			'panel_dtl_parent_id'  => decrypt($request->panel_id),
			'panel_dtl_parent_obj' => $lastInsertId,
			'created_by'           => $this->thisUser()->users_id,
			'created_date'         => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		Session::flash('success','Successfully Created');
		return back();
	}

	public function admin_update_inputtext($method, $id, $request)
	{
		app('PanelDetailsInputText')->where('text_id',decrypt($id))->update([
			'text_link'        => $request->text_path,
			'text_description' => $request->text_name,
			'updated_by'       => $this->thisUser()->users_id,
			'updated_date'     => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);

		$this->update_panel_details_order_level($request);
		
		Session::flash('success','Successfully Updated');
		return back();
	}

	public function admin_toggle_input_text_tab($method, $id, $request)
	{
		return app('PanelDetailsInputText')->where('text_id',decrypt($id))->update([
			'text_tab'     => $request->status,
			'updated_by'   => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s')
		]);
	}

	public function admin_toggle_input_text_status($method, $id, $request)
	{
		return app('PanelDetailsInputText')->where('text_id',decrypt($id))->update([
			'status'       => $request->status,
			'updated_by'   => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		]);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// ADD TO DETAILS ////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function admin_add_selected_panel_details($method, $id, $request)
	{
		$test2 = [];
	    foreach ($request->panel as $key => $value) 
	    {
	        if(array_key_exists('checkbox_id', $value)) {
	            app('PanelDetails')->insert([
	                'panel_dtl_type'       =>  $value['detail_type'],
	                'panel_dtl_parent_obj' =>  $value['checkbox_id'], 
	                'panel_dtl_parent_id'  =>  decrypt($value['panel_id']),
	                'created_by'           =>  $this->thisUser()->users_id,
	                'created_date'  	   =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	            ]);
	        }
	    }
	    Session::flash('success','Selected image(s) successfully added');
	    return back();
	}

	public function update_panel_details_order_level($request)
	{
		if($request->has('order_level')) {
			return app('PanelDetails')->where('panel_dtl_id',decrypt($request->detail_id))->update([
				'order_level'  => $request->order_level,
				'updated_by'   => $this->thisUser()->users_id,
				'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
			]);
		}
	}

	public function admin_toggle_panel_details_status($method, $id, $request)
	{
		return app('PanelDetails')->where('panel_dtl_id',decrypt($id))->update([
			'status'       => $request->status,
			'updated_by'   => $this->thisUser()->users_id,
			'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s')
		]);
	}

}