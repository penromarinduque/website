<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Traits\Gate\MainGate as MainGateTrait;

use App\Http\Traits\Accounts\UsersSettingTrait;
use App\Http\Traits\Accounts\UsersInformationTrait;

use App\Http\Traits\Common\UsersCommonTrait;
use App\Http\Traits\Common\ModuleCommonAccessTrait as ModuleTrait;
use App\Http\Traits\Common\SystemCommonAccessTrait as SystemTrait;

use App\Http\Traits\Common\SystemCommonSideBarTrait as SideBarTrait;

use App\Http\Traits\Settings\SystemFileUploaderTrait as FileUploader;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MainGateTrait, 
        UsersCommonTrait, UsersSettingTrait, UsersInformationTrait, ModuleTrait, SystemTrait, SideBarTrait,
        FileUploader;

    protected $activeModule;

    protected $activeCompany;

    protected $activePath;

    protected $activeAction;

    protected $activeId;

    public function __construct(Request $request)
    {
    	$this->activeModule = str_replace('/','',$request->route()->getPrefix());

    	$this->activePath = str_replace('/','',$request->route()->parameter('path'));

    	$this->activeAction = str_replace('/','',$request->route()->parameter('action'));

    	$this->activeId = $request->route()->parameter('id');
    }

    public function myViewLoader($window)
    {
        return view($window->menu_blade)
                    ->with('path', $window->menu_path)
                    ->with('windowName', $window->menu_name)
                    ->with('windowIcon', $window->menu_icon)
                    ->with('thisUser', $this->thisUser())
                    ->with('activeModule', $this->getModulePrefix())
                    ->with('activeSideBar', $this->getActiveSideBar())
                    ->with('usersActiveModule', $this->usersActiveModule($this->thisUser()->users_id));
    }

    public function myViewMethodLoader($method)
    {
        return view($method->method_blade)
                    ->with('path', $method->systemWindow->menu_path)
                    ->with('windowName', $method->systemWindow->menu_name)
                    ->with('windowIcon', $method->systemWindow->menu_icon)
                    ->with('thisUser', $this->thisUser())
                    ->with('activeModule', $this->getModulePrefix())
                    ->with('activeSideBar', $this->getActiveSideBar())
                    ->with('usersActiveModule', $this->usersActiveModule($this->thisUser()->users_id));
    }
}
