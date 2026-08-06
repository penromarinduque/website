<?php

namespace App\Http\Traits\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonServiceController as CommonService;
 
trait SystemWindowLoader
{

	public function settings_dashboard($window)
	{
		return $this->myViewLoader($window);
	}

	public function settings_company($window)
	{
		$allCompany = $this->allCompany();

		return $this->myViewLoader($window)
                    ->with('allCompany', $allCompany)
                    ->with('createCompany', $this->createSystemCompany);
	}

	public function settings_window($window)
	{

		$allWindow = $this->allWindow();
		
		return $this->myViewLoader($window)
                    ->with('allWindow', $allWindow)
                    ->with('createWindow', $this->createSystemWindow);

	}

	public function settings_module($window)
	{

		$allModule = $this->allModule();

		$usersCompanyAccess = $this->usersCompany();
		
		return $this->myViewLoader($window)
                    ->with('allModule', $allModule)
                    ->with('usersCompanyAccess', $usersCompanyAccess)
                    ->with('formSearchModule', $this->formSearchModule)
                    ->with('createWindow', $this->createSystemWindow);

	}

}