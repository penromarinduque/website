<?php

namespace App\Http\Traits\Website;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;

trait WebsiteNavMenuTrait
{

	public function getSearchResult($method, $id, $request)
	{
		return view($this->bladedir.'searchresult')->with('webdata',$this);
	}

	public function admin_add_navmenu($method, $id, $request)
	{
		$array = [
			'head_id' => $request->head_id,
			'nav_parent' => $request->nav_parent,
			'nav_name' => $request->nav_name,
			'nav_type' => $request->nav_type,
			'nav_tab' => $request->tab_type,
			'nav_path' => $request->nav_path,
			'nav_blade' => str_replace('-','',strtolower(trim($request->nav_path))),
			'nav_href' => '/penro/'.strtolower(trim($request->nav_path)),
		];

		$exists_count = app('NavHeaderDetails')->where('nav_link','penro')->where('nav_path',$request->nav_path)
						->where('nav_blade',str_replace('-','',strtolower(trim($request->nav_path))))
						->where('nav_href','/penro/'.strtolower(trim($request->nav_path)));

		if($exists_count->count() > 0) {
			Session::flash('failed','Description or Path is already exists.');
			return back();
		}

		$filepath = 'marinduque/website/pages/'.str_replace('-','',strtolower(trim($request->nav_path))).'.blade.php';

		if($request->has('with_directory'))
		{
			if(!Storage::disk('resources')->exists($filepath)) 
			{
				$file = 'marinduque/website/pages/default/written.blade.php';

				if(Storage::disk('resources')->put($file, $this->documentWrite($request->nav_name)))
				{
					Storage::disk('resources')->copy($file, $filepath);
				}
			}
		}

		$created = app('NavHeaderDetails')->insert($array);

		($created) ? Session::flash('success','New Menu successfully created') :

		Session::flash('failed', 'Something went wrong, Please try again') ;

		return back();
	}

	public function documentWrite($breadname = '')
	{
		return '@extends(\'pages.website.government.includes.layout\')

		@section(\'content\')

			@include(\'pages.website.government.includes.topnav\')

			@include(\'pages.website.government.includes.masterhead\')

			<div class="container-fluid bg-gray">
				<div class="container" style="margin-top: 20px;">
				 	<div class="row">
				 		<div class="col-lg-12">
					 		<nav aria-label="breadcrumb">
					 		  	<ol class="breadcrumb">
					 		    	<li class="breadcrumb-item"><a style="color: green; text-decoration: none;" href="/"> Home </a></li>
					 		    	<li class="breadcrumb-item active" aria-current="page"> ' . $breadname . ' </li>
					 		  	</ol>
					 		</nav>
					 	</div>

			 		 	@include(\'pages.website.government.includes.panels\',[\'value\' => $panel])

					</div>
				</div>
			</div>

			@include(\'pages.website.government.includes.agencyfooter\')

			@include(\'pages.website.government.includes.standardfooter\')

		@endsection';
	}

	public function admin_update_navmenu($method, $id, $request, $updated = [])
	{
		foreach($request->row as $key => $value) 
		{
		  	if(array_key_exists('checked',$value))
		  	{  
			  	$array = [
			  		'nav_name' => $value['nav_name'],
			  		'nav_parent' => $value['nav_parent'],
			  		'nav_href' => $value['nav_href'],
			  		'nav_link' => $value['nav_link'],
			  		'nav_path' => $value['nav_path'],
			  		'nav_blade' => $value['nav_blade'],
			  		'nav_type' => $value['nav_type'],
			  		'nav_tab' => $value['nav_tab'],
			  		'order_level' => $value['order_level'],
			  	];
		  		$updated[] = app('NavHeaderDetails')->where('nav_id',$key)->update($array);
		  	}
		}

		(array_sum($updated) > 0) ? Session::flash('success', array_sum($updated) . ' rows successfully updated') : '' ;

		return back();
	}

	public function admin_delete_navmenu($method, $id, $request)
	{
		$deleted = app('NavHeaderDetails')->where('nav_id', Crypt::decrypt($id))->delete();

		($deleted) ? Session::flash('success', 'Menu successfully deleted' ) :

		Session::flash('failed', 'Something went wrong, Please try again') ;

		return back();
	}

}