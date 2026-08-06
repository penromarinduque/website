<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WebsiteController extends BaseController
{
	
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // SETTINGS FOLDER
    // use \App\Http\Traits\Settings\SystemCompanyTrait;
    // use \App\Http\Traits\Settings\SystemCompanyDetailsTrait;
    // use \App\Http\Traits\Settings\SystemWindowTrait;
    // use \App\Http\Traits\Settings\SystemWindowMethodTrait;
    // use \App\Http\Traits\Settings\SystemModuleTrait;
    // use \App\Http\Traits\Settings\SystemCompanyModuleAccessTrait;
    
    // use \App\Http\Traits\Settings\UploaderTrait;
    // use \App\Http\Traits\Settings\UsersInformationTrait;
    // use \App\Http\Traits\Settings\UserSettingTrait;
    // use \App\Http\Traits\Settings\UsersTrait;
    // use \App\Http\Traits\Settings\UsersCompanyAccessTrait;
    // use \App\Http\Traits\Settings\UsersModuleAccessTrait;
    // use \App\Http\Traits\Settings\UsersWindowAccessTrait;
    // use \App\Http\Traits\Settings\UsersWindowMethodAccessTrait;
    // // ADMIN FOLDER
    // use \App\Http\Traits\Admin\UserPageSetupTrait;
    // WEBSITE FOLDER
    use \App\Http\Traits\WebsitePage\CenterPanelTrait;
    use \App\Http\Traits\WebsitePage\FooterTrait;
    use \App\Http\Traits\WebsitePage\FrontlineTrait;
    use \App\Http\Traits\WebsitePage\HeadCarouselTrait;
    use \App\Http\Traits\WebsitePage\LayoutTrait;
    use \App\Http\Traits\WebsitePage\MasterHeadTrait;
    use \App\Http\Traits\WebsitePage\NavMenuTrait;
    use \App\Http\Traits\WebsitePage\NavMethodTrait;
    use \App\Http\Traits\WebsitePage\SidePanelTrait;
    use \App\Http\Traits\WebsitePage\NavMenuGenerateTrait;
    use \App\Http\Traits\WebsitePage\SpecialTrait;

}
