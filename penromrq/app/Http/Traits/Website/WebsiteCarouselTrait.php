<?php

namespace App\Http\Traits\Website;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait WebsiteCarouselTrait 
{
	
	public function admin_search_carousel($method, $id, $request)
	{

		$window = $method->systemWindow;

		return $this->website_carousel_setup($window);

	}

	public function admin_add_carousel_group($method, $id, $request)
	{

		$this->validate($request,[
			'group_code' => 'required',
			'group_description' => 'required'
		]);

		$array = [
			'group_code' => $request->group_code,
			'group_name' => $request->group_description,
			'created_by' =>  $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		app('CarouselGroup')->insert($array);

		Session::flash('success', 'Carousel Group successfully created');

		return back();

	}

	public function admin_add_headcarousel($method, $id, $request)
	{

		$this->validate($request,[
			'carousel_text' => 'required',
			'carousel_link' => 'required',
			'carousel_btn_text' => 'required',
			'carousel_path' => 'mimes:'.$this->validatefile('I'),
		]);

		$array = [
			'status' => $request->carousel_status,
			'group_id' => $request->group_id,
			'carousel_text' => $request->carousel_text,
			'carousel_link' => $request->carousel_link,
			'carousel_btn_text' => $request->carousel_btn_text,
			'created_by' =>  $this->thisUser()->users_id,
			'created_date' =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if($request->hasFile('carousel_path')) {
			
			$imagePath = $this->profileUpload($request,'carousel_path');

			$array = Arr::add($array, 'carousel_path', $imagePath);

		} 

		app('CarouselGroupDetails')->insert($array);

		Session::flash('success', 'Carousel Successfully Created');

		return back();

	}

	public function admin_edit_headcarousel($method, $id, $request)
	{

		$this->validate($request,[
			'carousel_text' => 'required',
			'carousel_link' => 'required',
			'carousel_btn_text' => 'required',
			'carousel_path' => 'mimes:'.$this->validatefile('I'),
		]);

		$array = [
			'carousel_text' => $request->carousel_text,
			'carousel_link' => $request->carousel_link,
			'carousel_btn_text' => $request->carousel_btn_text,
		];

		$result = app('CarouselGroupDetails')->where('carousel_id', decrypt($id));

		if($result->count() > 0) {

			$imagePath = $this->profileUpload($request, 'carousel_path', $result->first()->carousel_path);

			$array = ($request->hasFile('carousel_path')) ? Arr::add($array, 'carousel_path', $imagePath) : $array ;

		}

		$result->update($array) ? Session::flash('success', 'Carousel Successfully Updated.') : '' ;

		return back();

	}

	public function admin_toggle_headcarousel($method, $id, $request)
	{	
		return app('CarouselGroupDetails')->where('carousel_id', decrypt($id))->update(['status' => $request->status]);
	}

	public function admin_delete_headcarousel($method, $id, $request)
	{
		$deleted = app('CarouselGroupDetails')->where('carousel_id', decrypt($id))->delete();

		Session::flash('success','Carousel Successfully Deleted');

		return back();
	}

}