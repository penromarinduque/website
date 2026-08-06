<?php

namespace App\Http\Controllers\Admin\Website;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    use \App\Http\Traits\Website\WebsiteDashboardTrait;
    use \App\Http\Traits\Website\WebsitePageSetupTrait;
    use \App\Http\Traits\Website\WebsiteCenterPanelTrait;
    use \App\Http\Traits\Website\WebsiteFooterTrait;
    use \App\Http\Traits\Website\WebsiteFrontlineTrait;
    use \App\Http\Traits\Website\WebsiteCarouselTrait;
    use \App\Http\Traits\Website\WebsiteLayoutTrait;
    use \App\Http\Traits\Website\WebsiteMasterHeadTrait;
    use \App\Http\Traits\Website\WebsiteNavMenuTrait;
    use \App\Http\Traits\Website\WebsiteNavigationTrait;
    use \App\Http\Traits\Website\WebsiteSidePanelTrait;
    use \App\Http\Traits\Website\WebsiteNavMenuGenerateTrait;
    use \App\Http\Traits\Website\WebsiteSpecialTrait;
    use \App\Http\Traits\Website\WebsiteWindowLoaderTrait;
}
