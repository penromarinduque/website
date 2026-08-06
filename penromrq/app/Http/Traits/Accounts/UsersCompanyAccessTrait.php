<?php

namespace App\Http\Traits\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersCompanyAccessTrait
{
	public function accounts_update_users_company_access($method, $id = null, $request)
	{
		if( !is_null($request->company ) ) {
			foreach ($request->company as $key => $value) {
				$companyAccess = app('UsersCompanyAccess')
					->where('users_id', decrypt($value['users_id']))
					->where('company_id', decrypt($value['company_id']));
			    if( array_key_exists('checkbox', $value) ) {
			    	if( count($companyAccess->first()) == 0 ) {
				        app('UsersCompanyAccess')->insert([
				        	'users_id' => decrypt($value['users_id']), 
				        	'company_id' => decrypt($value['company_id']),
				        	'created_by' => $this->thisUser()->users_id,
				        	'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),  
				        ]);
				    } 
				} else {
					$companyAccess->delete();
				}
			}
		}
	}
}