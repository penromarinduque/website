<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait UsersCommonTrait 
{
	public function allUsers($user = [])
	{
		$users = app('Users');

		return (count($user) > 0) ? $users->whereIn('users_id', $user)->orderBy('order_level','asc')->get() : 

									$users->orderBy('order_level','asc')->get() ; 
	}

	public function activeUsers($user = null)
	{
		$users = app('Users')->where('status','1');

		return (!is_null($user)) ? $users->where('users_id', $user)->first() : $users->orderBy('order_level','asc')->get() ; 
	}

	public function usersAllModule($user = null, $company = null)
	{
		$UsersModuleAccess = app('UsersModuleAccess')->where('users_id', $user);

		if(!is_null($company)) {
			$UsersModuleAccess = $UsersModuleAccess->where('company_id', $company); 
		} 

		$UsersModuleAccess = $UsersModuleAccess->orderBy('order_level','asc')->get();

		$modules = Arr::pluck($UsersModuleAccess, 'module_id');

		return $this->allModule($modules);
	}

	public function usersActiveModule($user = null)
	{
		$usersModuleAccess = app('UsersModuleAccess')->where('users_id', $user)->where('status','1')->orderBy('order_level','asc')->get(); 

		$modules = Arr::pluck($usersModuleAccess, 'module_id');

		return $this->allModule($modules); 
	}

	public function usersActiveWindow($user = null)
	{
		$activeModule = $this->getModulePrefix();

		$usersWindowAccess = app('UsersWindowAccess')
									->where('users_id', $user)
									->where('module_to', $activeModule->module_id)
									->where('status','1')->orderBy('order_level','asc')->get(); 

		$windows = Arr::pluck($usersWindowAccess, 'menu_id');

		return $this->allWindow($windows); 
	}

	public function usersActiveWindowMethod($user = null)
	{
		$usersWindowMethodAccess = app('UsersWindowMethodAccess')
									->where('users_id', $user)
									->where('status','1')->orderBy('order_level','asc')->get(); 

		$windowMethods = Arr::pluck($usersWindowMethodAccess, 'method_id');

		return $this->allWindowMethod($windowMethods); 
	}

	public function usersDefaultCompany($user)
	{
		return $this->activeUsers($user)->companyInfo;
	}

	public function usersAllCompany($user = null)
	{
		$UsersCompanyAccess = app('UsersCompanyAccess')->where('users_id', $user)->orderBy('order_level','asc')->get();

		$company = Arr::pluck($UsersCompanyAccess, 'company_id');

		return $this->allCompany($company);
	}

	public function usersActiveCompany($user = null)
	{
		$UsersCompanyAccess = app('UsersCompanyAccess')->where('users_id', $user)->where('status','1')->orderBy('order_level','asc')->get(); 

		$company = Arr::pluck($UsersCompanyAccess, 'company_id');

		return $this->allCompany($company); 
	}

}