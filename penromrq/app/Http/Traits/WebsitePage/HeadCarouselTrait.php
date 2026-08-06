<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait HeadCarouselTrait 
{
	public function admin_filter_headcarousel($method, $id, $request)
	{
		$path = $method->parentCLass->menu_path;

		return view($method->parentCLass->menu_blade)->with('path',$path)->with('webdata',$this);
	}

	public function admin_add_carousel_group($method, $id, $request)
	{
		$array = [
			'group_code' => $request->group_code,
			'group_name' => $request->group_description,
			'created_by' =>  $this->thisUser()->id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$created = app('CarouselGroup')->insert($array);

		( $created ) ? Session::flash('success', 'Head Carousel successfully created') : '' ;

		return back();
	}

	public function admin_add_headcarousel($method, $id, $request)
	{
		$this->validate($request,[
			'carousel_text' => 'required',
			'carousel_btn_text' => 'required',
			'carousel_link' => 'required',
			'carousel_path' => 'mimes:'.$this->validatefile('I'),
		]);

		$array = [
			'group_id' => $request->group_id,
			'carousel_text' => $request->carousel_text,
			'carousel_btn_text' => $request->carousel_btn_text,
			'carousel_link' => $request->carousel_link,
			'status' => $request->carousel_status,
			'created_by' =>  $this->thisUser()->id,
			'created_date' =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$arrays = ($request->hasFile('carousel_path')) ? Arr::add($array, 'carousel_path' ,$this->profileUpload($request,'carousel_path')) : $array ;

		$created = app('CarouselGroupDetails')->insert($arrays);

		( $created ) ? Session::flash('success', 'Head Carousel successfully created') : '' ;

		return back();
	}

	public function admin_edit_headcarousel($method, $id, $request)
	{

		$this->validate($request,[
			'carousel_text' => 'required',
			'carousel_btn_text' => 'required',
			'carousel_link' => 'required',
			'carousel_path' => 'mimes:'.$this->validatefile('I'),
		]);

		$array = [
			'carousel_text' => $request->carousel_text,
			'carousel_btn_text' => $request->carousel_btn_text,
			'carousel_link' => $request->carousel_link,
		];

		$result = app('CarouselGroupDetails')->where('carousel_id', Crypt::decrypt($id));

		if($result->count() > 0)
		{
			$array = ($request->hasFile('carousel_path')) ? 

				Arr::add($array, 'carousel_path' ,$this->profileUpload($request,'carousel_path',$result->first()->carousel_path)) : $array ;
		}

		$updated = $result->update($array);

		( $updated ) ? Session::flash('success', 'Head Carousel successfully updated!') : '' ;

		return back();

	}

	public function admin_toggle_headcarousel($method, $id, $request)
	{	
		return app('CarouselGroupDetails')->where('carousel_id', Crypt::decrypt($id))->update(['status' => $request->status ]);
	}

	public function admin_delete_headcarousel($method, $id, $request)
	{
		$deleted = app('CarouselGroupDetails')->where('carousel_id',Crypt::decrypt($id))->delete();

		Session::flash('success','Head Carousel successfully deleted!');

		return back();
	}

}