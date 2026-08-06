<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait SystemCommonAccessTrait
{
	/* SYSTEM COMPANY */
	public function allCompany($company = [])
	{
		$systemCompany = app('SystemCompany');

		return (count($company) > 0) ? $systemCompany->whereIn('company_id', $company)->orderBy('order_level','asc')->get() : 

									   $systemCompany->orderBy('order_level','asc')->get() ; 
	}

	public function activeCompany($company = null)
	{
		$systemCompany = app('SystemCompany')->where('status','1');

		return (!is_null($company)) ? $systemCompany->where('company_id', $company)->first() : $systemCompany->get() ; 
	}

	public function companyModule($company)
	{
		$companyModule = $this->activeCompany($company)->companyModuleInfo;

		$modules = Arr::pluck($companyModule, 'module_id');

		return (count($modules) > 0) ? $this->allModule($modules) : [] ; 
	}

	public function moduleWindow($module)
	{
		$moduleWindow = $this->activeModule($module)->windowInfo;

		$window = Arr::pluck($moduleWindow, 'menu_id');

		return (count($window) > 0) ? $this->allWindow($window) : [] ; 
	}

	public function moduleWindowMethod($module)
	{
		$moduleWindowMethod = $this->activeModule($module)->windowMethodInfo;

		$windowMethod = Arr::pluck($moduleWindowMethod, 'menu_id');

		return (count($windowMethod) > 0) ? $this->allWindowMethod($windowMethod) : [] ; 
	}

	public function companyUsers($company)
	{
		$companyUsers = $this->activeCompany($company)->usersInfo;

		$users = Arr::pluck($companyUsers, 'users_id');

		return $this->allUsers($users); 
	}

	public function allWindow($windows = [], $withoutDropDownMenu = false)
	{
		$systemWindow = app('SystemWindow');

		$systemWindow = $withoutDropDownMenu ? $systemWindow->where('menu_type','0') : $systemWindow ;

		return (count($windows) > 0) ? $systemWindow->whereIn('menu_id', $windows)->orderBy('order_level','asc')->get() : 

									   $systemWindow->orderBy('order_level','asc')->get() ; 
	}

	public function allActiveWindow($windows = null)
	{
		$systemWindow = app('SystemWindow')->where('menu_status','1')->where('menu_type','0');

		return (!is_null($windows) > 0) ? $systemWindow->where('menu_id', $windows)->first() : 

									      $systemWindow->orderBy('module_id','asc')->orderBy('order_level','asc')->get() ; 
	}

	public function allWindowMethod($methods = [])
	{
		$systemWindowMethod = app('SystemWindowMethod');

		return (count($methods) > 0) ? $systemWindowMethod->whereIn('menu_id', $methods)->orderBy('order_level','asc')->get() : 

									   $systemWindowMethod->orderBy('order_level','asc')->get() ; 
	}

}