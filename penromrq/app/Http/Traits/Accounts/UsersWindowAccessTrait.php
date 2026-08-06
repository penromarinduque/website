<?php 

namespace App\Http\Traits\Accounts;

use Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersWindowAccessTrait
{
	public function accounts_update_users_window_access($method, $id = null, $request) 
	{
		if( !is_null($request->window ) ) {
		    foreach ($request->window as $key => $value) {
		    	$windowAccess = app('UsersWindowAccess')
						->where('users_id', decrypt($value['users_id']))
						->where('menu_id', decrypt($value['menu_id']))
						->where('menu_parent', decrypt($value['menu_parent']))
						->where('menu_type', decrypt($value['menu_type']))
						->where('module_to', decrypt($value['module_to']))
						->where('module_from', decrypt($value['module_from']));
				
		    	if( array_key_exists( 'checkbox' , $value ) ) {
		    		$test[] = count($windowAccess->first());
		        	if( count($windowAccess->first()) == 0 ) {
		        		$array = [ 
	                		'menu_id'      => decrypt($value['menu_id']), 
	                		'users_id'     => decrypt($value['users_id']),
	                		'module_to'    => decrypt($value['module_to']),
	                		'module_from'  => decrypt($value['module_from']),
	                		'menu_type'    => decrypt($value['menu_type']),
	                		'menu_parent'  => decrypt($value['menu_parent']),
	                		'created_by'   => $this->thisUser()->users_id,
							'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
                		];
                		app('UsersWindowAccess')->insert($array);
		            }
		        } else {
	                $windowAccess->delete(); 
		        }
		    }
		    return $test;
		}
	}
}