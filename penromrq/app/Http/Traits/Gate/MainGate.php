<?php

namespace App\Http\Traits\Gate;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait MainGate
{
	
	public function activeAdmin(Request $request, $path, $action = null, $id = null)
	{

        if($this->validateUsersModuleAccess()) {

            if(!empty($this->validateUsersWindowExists())) {

                if($this->validateUsersWindowAccess()) {

                    if(!is_null($this->activeAction) && !is_null($this->activeId)) {

                        return $this->activemethod($request);
                        
                    } else {
                        // if($this->validateTraitMethod($window['menu_trait'], $window['menu_method'])) {
                            $window = $this->validateUsersWindowExists();

                            $method = $window->menu_method;

                            return $this->$method($window);
                        // } else {
                            // Session::flash('failed','Error #005 - Undefine function for this page.');
                            // return back();
                        // } 
                    }

                } else {
                    Session::flash('failed','Error #004 - You do not have permission to access this window.');
                    return back();
                }

            } else {
                Session::flash('failed','Error #003 - The page or url you are looking do not exists to this module');
                return back();
            }

        } else {
            Session::flash('failed','Error #002 - You do not have permission to access this module, Contact your system administrator for more info.');
            return back();
        }

	}

	public function activemethod($request)
	{

	    $windowMethod = $this->validateUsersWindowExists()->subClassMethod()
								->where('method_name', $this->activeAction)
								->where('status','1')
								->first();
	    // if($this->validateUsersWindowMethodAccess()) {
	    	if(!empty($windowMethod) && method_exists(app($windowMethod->method_traits), $windowMethod->method_function)) {   
	    		
	    	    $method = $windowMethod->method_function;

	    	    return $this->$method($windowMethod, $this->activeId, $request);

	    	} else {
	    	    Session::flash('failed','This action does not belong to this module.');
	    	    return back();
	    	}
	    // } else {
	    	// Session::flash('failed','Please contact your system administrator for your access rights.');
	    	// return back();
	    // }
	}

	public function validateUsersModuleAccess()
	{
	    // $usersActiveModule = $this->usersActiveModule($this->thisUser()->users_id);
	    $usersActiveModule = $this->usersAllModule($this->thisUser()->users_id, $this->thisUser()->company_id);

	    $usersModuleAccess = Arr::pluck($usersActiveModule,'module_prefix');

	    return (count($usersActiveModule) > 0 ) ? in_array($this->activeModule, $usersModuleAccess) : false ;
	}

	public function validateUsersWindowExists()
	{
		$moduleId = $this->getModulePrefix()->module_id;

	    return app('SystemWindow')->where('menu_path', $this->activePath)->where('module_id', $moduleId)->first();
	}

	public function validateUsersWindowAccess()
	{
		$usersActiveWindow = $this->usersActiveWindow($this->thisUser()->users_id);

	    $usersWindowAccess = Arr::pluck($usersActiveWindow,'menu_path');

	    return (count($usersActiveWindow) > 0 ) ? in_array($this->activePath, $usersWindowAccess) : false ;
	}

	public function validateUsersWindowMethodAccess() 
	{
	    $usersActiveWindowMethod = $this->usersActiveWindowMethod($this->thisUser()->users_id);

	    $usersWindowAccess = Arr::pluck($usersActiveWindowMethod,'method_name');

	    return (count($usersActiveWindowMethod) > 0 ) ? in_array($this->activeAction, $usersWindowAccess) : false ;
	}

	public function error404()
	{
	    return redirect('/welcome');
	}

}
