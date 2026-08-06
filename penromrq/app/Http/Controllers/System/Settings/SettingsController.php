<?php

namespace App\Http\Controllers\System\Settings;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller 
{
    use \App\Http\Traits\Settings\SystemCommonTrait;
    use \App\Http\Traits\Settings\SystemCompanyTrait;
    use \App\Http\Traits\Settings\SystemCompanyDetailsTrait;
    use \App\Http\Traits\Settings\SystemWindowTrait;
    use \App\Http\Traits\Settings\SystemWindowMethodTrait;
    use \App\Http\Traits\Settings\SystemModuleTrait;
    use \App\Http\Traits\Settings\SystemCompanyModuleAccessTrait;
    use \App\Http\Traits\Settings\SystemFileUploaderTrait;
    use \App\Http\Traits\Settings\SystemMethodLoaderTrait;
	// CREATE
    protected $createSystemWindow = 'settings-create-system-window';
	protected $createSystemCompany = 'settings-create-system-company';
    protected $formSearchModule = 'settings-search-system-module';
    // UPDATE
    protected $updateSystemWindow = 'settings-update-system-window';
    protected $updateSystemCompany = 'settings-update-system-company';

    // DELETE
    protected $deleteSystemWindow = 'settings-delete-system-window';
    protected $deleteSystemCompany = 'settings-delete-system-company';

    // TOGGLES
    protected $toggleSystemWindow = 'settings-toggle-system-window';
    protected $toggleSystemCompany = 'settings-toggle-system-company';
}
