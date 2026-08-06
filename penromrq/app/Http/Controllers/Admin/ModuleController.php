<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller 
{
	public function loginForm()
	{
		return view('auth.login');
	}

	public function moduleDashboard()
	{
		$thisUser = $this->thisUser();

		$usersCompany = $this->usersAllCompany($thisUser->users_id);

		$usersActiveModule = $this->usersAllModule($thisUser->users_id, $thisUser->company_id);

		return view('welcome')->with('usersModule', $usersActiveModule)->with('thisUser', $thisUser)->with('usersCompany', $usersCompany);
	}
}