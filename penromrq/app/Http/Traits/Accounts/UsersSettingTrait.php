<?php

namespace App\Http\Traits\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait UsersSettingTrait
{
    public function accounts_users_user_profile($method, $id = null, $request)
    {
        $thisUser = $this->activeUsers(decrypt($id));

        return $this->myViewMethodLoader($method)
                            ->with('withAccessTab', '')
                            ->with('thisUserAccount', $thisUser);
    }

    public function accounts_users_user_company($method, $id = null, $request)
    {
        $systemCompany = $this->activeCompany();
        $thisUserAccou = $this->activeUsers(decrypt($id));
        $userCompanies = $this->getUserCompanyAccess(decrypt($id));

        return $this->myViewMethodLoader($method)
                            ->with('usersCompany', $userCompanies)
                            ->with('systemCompany', $systemCompany)
                            ->with('thisUserAccount', $thisUserAccou);
    }

    public function accounts_users_user_module($method, $id = null, $request)
    {
        $thisUser = $this->activeUsers(decrypt($id));

        $usersCompany = $this->usersAllCompany(decrypt($id));

        $companyModule = $this->companyModule($thisUser->company_id);

        $moduleAccess = $this->getUserModuleAccess(decrypt($id), $thisUser->company_id);

        return $this->myViewMethodLoader($method)
                            ->with('companyId', $thisUser->company_id)
                            ->with('moduleAccess', $moduleAccess)
                            ->with('usersCompany', $usersCompany)
                            ->with('companyModule', $companyModule)
                            ->with('thisUserAccount', $thisUser);
    }

    public function accounts_users_user_window($method, $id = null, $request)
    {
        $activeModule = $this->getModulePrefix();

        $thisUserAcct = $this->activeUsers(decrypt($id));

        $usersModules = $this->usersAllModule(decrypt($id));

        $usersCompany = $this->usersAllCompany(decrypt($id));

        $windowAccess = $this->getUserWindowAccess(decrypt($id));

        $moduleWindow = $this->moduleWindow($activeModule->module_id);

        return $this->myViewMethodLoader($method)
                            ->with('moduleTo', $activeModule)
                            ->with('allWindow', $moduleWindow)
                            ->with('usersModule', $usersModules)
                            ->with('windowAccess', $windowAccess)
                            ->with('usersCompany', $usersCompany)
                            ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_users_user_method($method, $id = null, $request)
    {
        $activeModule = $this->getModulePrefix();

        $thisUserAcct = $this->activeUsers(decrypt($id));

        $usersModules = $this->usersAllModule(decrypt($id));

        $usersCompany = $this->usersAllCompany(decrypt($id));

        $moduleWindow = $this->moduleWindow($activeModule->module_id);

        $windowAccess = $this->getUserWindowAccess(decrypt($id));

        $methodAccess  = $this->getUserWindowMethodAccess(decrypt($id));

        $windowMethod = $this->moduleWindowMethod($activeModule->module_id);

        return $this->myViewMethodLoader($method)
                            ->with('moduleTo', $activeModule)
                            ->with('usersCompany', $usersCompany)
                            ->with('usersModule', $usersModules)
                            ->with('windowAccess', $windowAccess)
                            ->with('moduleWindow', $moduleWindow)
                            ->with('allMethods', $windowMethod)
                            ->with('methodAccess', $methodAccess)
                            ->with('thisUserAccount', $thisUserAcct);
    }

    /*
     * Call by AJX Request
     * @return Table for Company Module 
     * pages.system.accounts.includes.TableUsersModuleAccess
     */
    public function accounts_search_company_module($method, $id = null, $request)
    {   
        $thisUserAcct = $this->activeUsers(decrypt($id));

        $companyModule = $this->companyModule($request->company_id);

        $moduleAccess = $this->getUserModuleAccess(decrypt($id), $request->company_id);

        return view($method->method_blade)
                    ->with('companyId', $request->company_id)
                    ->with('moduleAccess', $moduleAccess)
                    ->with('companyModule', $companyModule)
                    ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_search_company_module_json($method, $id = null, $request)
    {
        $usersAllCompanyModule = $this->usersAllModule(decrypt($id), $request->company_id);

        return $usersAllCompanyModule;
    }

    /*
     * Call by AJX Request
     * @return Table for Users Company Access Only
     * pages.system.accounts.includes.TableUsersCompanyAccess
     */
    public function accounts_search_users_company($method, $id = null, $request)
    {
        $usersCompany = $this->usersAllCompany(decrypt($request->users_id));

        return $this->view($method->method_blade)->with('usersCompany', $usersCompany);
    }

    public function accounts_search_users_module($method, $id, $request) 
    {
        $usersModule = $this->usersAllModule(decrypt($request->users_id));

        return view($method->method_blade)->with('usersModule', $usersModule);
    }

    public function accounts_search_users_window($method, $id, $request)
    {
        $thisUserAcct = $this->activeUsers(decrypt($id));

        $moduleWindow = $this->moduleWindow($request->module_to);

        $windowAccess = $this->getUserWindowAccess(decrypt($id), $request->module_to, $request->module_to);
        
        return view($method->method_blade)
                    ->with('moduleTo', $request->module_to)
                    ->with('moduleFrom', $request->module_to)
                    ->with('allWindow', $moduleWindow)
                    ->with('windowAccess', $windowAccess)
                    ->with('thisUserAccount', $thisUserAcct);
    }

    public function accounts_search_users_method($method, $id, $request)
    {
        $thisUser = $this->activeUsers(decrypt($id));

        $usersWindowMethod = $this->usersActiveWindow(decrypt($request->users_id));

        return $this->view($method->method_blade)
                    ->with('thisUserAccount',$thisUser)
                    ->with('allMethods',$usersWindowMethod)
                    ->with('methodAccess', $this->getUserWindowMethodAccess(decrypt($id)));
    }

    public function accounts_search_company_users($method, $id = null, $request, $users = [])
    {
        $companyUsers = $this->companyUsers(decrypt($request->company_id));

        return $this->view($method->method_blade)->with('allUsers', $companyUsers);
    }

    public function settings_retrieve_window_sub_class($method, $id, $request)
    {
        $jsonResponse = app('SystemWindow')->where('menu_status','1')
                            ->where('menu_parent',$request->parent)
                            ->orderBy('order_level','asc')
                            ->get();

        return response()->json($jsonResponse);
    }

    public function settings_view_blade_access($method, $id, $request)
    {
        return $this->myViewMethodLoader($method);
    }
    
    public function settings_view_users_profile($method, $id, $request)
    {
        return $this->myViewMethodLoader($method)
                        ->with('UserDetails',$this->getUser($id));
    }

	public function settings_view_users_access($method, $id, $request)
	{
		return $this->myViewMethodLoader($method)
                        ->with('UserDetails',$this->getUser($id))
				        ->with('UserWindowAcces',$this->getUserWindowAccess(decrypt($id)));
	}

	public function settings_view_add_menu($method, $id, $request)
	{
	    return $this->myViewMethodLoader($method);
	}

    public function settings_search_users_method($method, $id, $request)
    {
        $allMethods = $this->moduleWindowMethod($request->module_from);

        return $this->myViewMethodLoader($method)->with('allMethods', $allMethods);
    }
}
