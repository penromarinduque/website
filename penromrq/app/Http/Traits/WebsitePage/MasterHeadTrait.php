<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait MasterHeadTrait
{
	public function admin_edit_masterhead($method, $id, $request)
	{
		$this->validate($request,[
			'head_title' => 'required',
			'head_description' => 'required',
			'head_tagline' => 'required',
			'head_location' => 'required',
		]);
		
		$array = [
			'head_title' => $request->head_title,
			'head_description' => $request->head_description,
			'head_tagline' => $request->head_tagline,
			'head_location' => $request->head_location,
		];

		if($request->hasFile('head_logo'))
		{
			$this->validate($request,[
				'head_logo' => 'mimes:'.$this->validatefile('I'),
			]);

			$array = Arr::add($array, 'head_logo', $this->profileUpload($request,'head_logo') );
		}

		if($request->hasFile('footer_logo'))
		{
			$this->validate($request,[
				'footer_logo' => 'mimes:'.$this->validatefile('I'),
			]);

			$array = Arr::add($array, 'footer_logo', $this->profileUpload($request,'footer_logo') );
		}

		$updated = app('MasterHead')->where('head_id','1')->update($array);

		( $updated ) ? Session::flash('success', 'Master Head successfully updated') : '' ;

		return back();
	}
}