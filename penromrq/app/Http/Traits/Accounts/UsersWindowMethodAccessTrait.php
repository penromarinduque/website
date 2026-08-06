<?php 

namespace App\Http\Traits\Accounts;

use Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersWindowMethodAccessTrait
{
	public function settings_update_users_method_access($method, $id = null, $request)
	{
		if( !is_null($request->method) ) {
			foreach($request->method as $key => $value) {
				$methodAccess = app('UsersWindowMethodAccess')
									->where('users_id', decrypt($value['users_id']))
									->where('method_id', decrypt($value['method_id']));
				if( array_key_exists('checkbox', $value) ) { 
					if( count($methodAccess->first()) == 0 ) {
						app('UsersWindowMethodAccess')->insert([
							'users_id' => decrypt($value['users_id']),
							'method_id' => decrypt($value['method_id']),
							'created_by' => $this->thisUser()->users_id,
							'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
						]);
					}
				} else {
					$methodAccess->delete(); /* DELETE IF EXISTS BUT NOT SELECTED */
				}
			}
		}
	}
}