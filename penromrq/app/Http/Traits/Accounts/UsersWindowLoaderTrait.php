<?php

namespace App\Http\Traits\Accounts;

use Session;
use Illuminate\Http\Request;

trait UsersWindowLoaderTrait 
{	
	public function accounts_dashboard($window)
	{
		return $this->myViewLoader($window);
	}

	public function accounts_users($window)
	{
		$allUsers = $this->allUsers();

		$usersCompany = $this->usersAllCompany($this->thisUser()->company_id);

		return $this->myViewLoader($window)->with('allUsers', $allUsers)->with('usersCompany', $usersCompany);
	}

	public function accounts_users_profile($window)
	{
		$thisUser = $this->thisUser();
		
		return $this->myViewLoader($window)->with('thisUserAccount', $thisUser);
	}
}