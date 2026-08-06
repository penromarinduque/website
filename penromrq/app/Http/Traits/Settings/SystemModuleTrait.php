<?php

namespace App\Http\Traits\Settings;

use Storage;
use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait SystemModuleTrait
{

	public function settings_search_system_module($method, $id = null, $request)
	{
		return $this->myViewMethodLoader($method)
		            ->with('company_id', $request->company_id)
		            ->with('module', []);
	}

	public function settings_toggle_system_module($method, $id = null, $request)
	{
		$exists_count = app('UsersModuleAccess')->where('module_id', decrypt($id))->get();

		if(count($exists_count) == 0) {
			return app('SystemModule')->where('module_id', decrypt($id))->update(['status' => $request->status]);
		}
	}

	public function settings_update_system_module($method, $id = null, $request)
	{
    	foreach ($request->module as $key => $value) {
    		if( array_key_exists('module_id', $value)) {
				$SystemModule = app('SystemModule')->where('module_id', decrypt($value['module_id']))->first();
    			// if( count($SystemModule) > 0) {
    			if( !empty($SystemModule) ) {
    				app('SystemModule')->where('module_id', decrypt($value['module_id']))->update([
    					'module_description' => $value['module_description'],
    					'module_name' => $value['module_name'],
    					'module_icon' => $value['module_icon'],
    					'module_class' => $value['module_class']
    				]);
				}
	    	}
    	}
	}

	public function settings_delete_system_module($method, $id = null, $request)
	{
		foreach ($request->module as $module_id => $value) {
			if( array_key_exists('module_id', $value)) {
				$module_table = app('SystemModule')->where('module_id', $module_id);
				$exists_count = app('UsersModuleAccess')->where('module_id', $module_id)->get();
				if( count($exists_count) > 0) {
					$message[] = 'Cannnot delete module ' . $module_table->first()['module_description'] . ', because it is still in use.';
				} else {
					$message[] = 'Module ' . $module_table->first()['module_description'] . ' successfully deleted.';
					$module_table->delete();
				}
			}
		}
		return $this->myViewMethodLoader($method)->with('error_message', $message);
	}

	public function settings_create_system_module($method, $id = null, $request, $message = '')
	{
		$this->validate($request,[
			'module_code' => 'required|min:6',
			'module_description' => 'required',
			'module_name' => 'required',
			'module_route' => 'required',
			'module_icon' => 'required',
			'module_class' => 'required',
		]);
		
		$arrays = [
			'module_code' => strtolower($request->module_code),
			'module_description' => $request->module_description,
			'module_name' => strtoupper($request->module_name),
			'module_route' => strtolower($request->module_code).'/home',
			'module_page_route' => 'pages.admin.'.strtolower($request->module_code),
			'module_icon' => strtolower($request->module_icon),
			'module_class' => strtolower($request->module_class),
			'order_level' => (new CommonService)->orderLevel(app('SystemModule')),
			'created_by' => $this->thisUser()->users_id,
			'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
		];

		$created = app('SystemModule')->insert($arrays);

		if($created > 0) {
			Session::flash('success','New module successfully created');
			return back();
		} else {
			Session::flash('success','Whoops! Something wrong during the process, Please try again.');
			return back();
		}
	}
}
