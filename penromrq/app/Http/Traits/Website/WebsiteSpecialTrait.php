<?php

namespace App\Http\Traits\Website;

use Crypt;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait WebsiteSpecialTrait 
{
	public function admin_add_editor_image($method, $id, $request)
	{

		$model = app('PanelDetailsStorage');

		$array = [
		    'file_type'   => 'I',
			'file_name'   => 'Added on Text editor uploaded file',
		    'order_level' => (new CommonService)->orderLevel($model),
		    'created_by'  => $this->thisUser()->users_id,
		    'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		if($request->hasFile('image'))
		{
			$image = $request->file('image');

	       	$extension = $image->getClientOriginalExtension();

			if(in_array($extension, explode(',',$this->validatefile('I'))))
			{
				$array = Arr::add($array,'file_path', $this->profileUpload($request,'image'));

				if($model->insert($array))
				{
					return ['message' => 'New image was successfully uploaded.','path' => $array['file_path']];
				}
			}
			else
			{
				return ['message' => 'Please select valid file for image. only(\'' . $this->validatefile('I') . '\')','path' => ''];
			}
		}else{
			return ['message' => 'Please select image to upload.','path' => ''];
		}

	}

	public function admin_view_news_and_events($method, $id, $request)
	{
	    $details = $this->center_details(Crypt::decrypt($id));

	    return (\View::exists($method->nav_blade)) ?

	        view($method->nav_blade)->with('path', $method->parentClass()->first()->menu_path )->with('webdata', $this)->with('details', $details) : 

	        $this->error404();

	}
}

