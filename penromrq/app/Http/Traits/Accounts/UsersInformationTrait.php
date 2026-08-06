<?php

namespace App\Http\Traits\Accounts;

use Auth;
use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait UsersInformationTrait 
{
	
	public function thisUser()
	{
		return Auth::User();
	}

	public function thisUserDefaultCompany($id = null)
	{
		$userId = (is_null($id)) ? $this->thisUser()->users_id : $id ;

		$thisUser = app('Users')->where('users_id',$userId)->first();

		return $thisUser->companyInfo()->first();
	}

	public function usersCompany($id = null)
	{
		$userCompany = (is_null($id)) ? $this->getUserCompanyAccess($this->thisUser()->users_id) : $this->getUserCompanyAccess($id) ; 

		return app('SystemCompany')->whereIn('company_id', $userCompany)->where('status','1')->orderBy('order_level','asc')->get();
	}

	public function allUsersPerCompany()
	{

		$users = app('Users')->where('status','1');

		if( $this->thisUser()->position == '3' ) {

			$users = $users->where('company_id', $this->thisUser()->company_id);

		} else if ( $this->thisUser()->position == '2' ) {

			$users = $users->where('company_id', $this->thisUser()->company_id);

		} else if ( $this->thisUser()->position == '1' ) {

			$users = $users;

		}

		return $users->get();

	}

	public function getUser($user)
	{
		return app('Users')->where('users_id', decrypt($user))->first();
	}

	/* 
	 * Get Module Access of a Company in Array of module_id
	 * @return Array
	*/
	public function getCompanyModuleAccess($id)
	{
		$systemCompany = app('SystemCompany')->where('company_id',$id)->first();
		
		$moduleAccess = $systemCompany->modulesAccess()->get();

		return (count($moduleAccess) > 0) ? Arr::pluck($moduleAccess,'module_id') : [];
	}


	public function getUserModuleAccess($id, $company)
	{
		$users = app('Users')->where('users_id', $id)->first();

		$moduleAccess = $users->moduleAccess()->where('company_id', $company)->get();

		return (count($moduleAccess) > 0) ? Arr::pluck($moduleAccess,'module_id') : [];
	} 

	/* 
	 * Get Company Access of a User in Array of module_id
	 * @return Array
	*/
	public function getUserCompanyAccess($id)
	{
		$user = app('Users')->where('users_id', $id)->first();

		$companyAccess = $user->companyAccess()->get();

		return (count($companyAccess) > 0) ? Arr::pluck($companyAccess,'company_id') : [];
	} 
	/* USERS WINDOW ACCESS */
	public function getUserWindowAccess($id, $module_to = null, $module_from = null)
	{
		$users = app('Users')->where('users_id', $id)->first();

		$moduleTo = (!is_null($module_to)) ? $module_to : $this->getModulePrefix()->module_id ;

		$windowAccess = $users->windowAccess()->where('module_to', $moduleTo);

		if(!is_null($module_from)) {
			$windowAccess = $windowAccess->where('module_from', $module_from);
		}

		$windowAccess = $windowAccess->get();

		return (count($windowAccess) > 0) ? Arr::pluck($windowAccess,'menu_id') : [];
	}
	/* USERS METHOD ACCESS */
	public function getUserWindowMethodAccess($id)
	{
		$user = app('Users')->where('users_id', $id)->first();

		$methodAccess = $user->windowMethodAccess()->get();

		return (count($user) > 0) ? Arr::pluck($methodAccess,'method_id') : [] ;
	}

}