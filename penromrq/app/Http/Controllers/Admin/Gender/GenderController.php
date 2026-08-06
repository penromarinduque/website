<?php

namespace App\Http\Controllers\Admin\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenderController extends Controller 
{
	use \App\Http\Traits\Gender\GenderDashboardTrait; 
	use \App\Http\Traits\Gender\GenderCarouselSetupTrait;
	use \App\Http\Traits\Gender\GenderNavigationSetupTrait;
	use \App\Http\Traits\Gender\GenderWebsiteTrait;
	use \App\Http\Traits\Gender\GenderPageSetupTrait;
	use \App\Http\Traits\Gender\GenderPanelTrait;
	use \App\Http\Traits\Gender\GenderActivityTrait; 
	use \App\Http\Traits\Gender\GenderIssuanceTrait; 
	use \App\Http\Traits\Gender\GenderCommonTrait; 
	use \App\Http\Traits\Gender\GenderMemorandumTrait; 
	use \App\Http\Traits\Gender\GenderSpecialOrderTrait; 
	use \App\Http\Traits\Gender\GenderPhotoReleasesTrait; 
	use \App\Http\Traits\Gender\GenderFeaturedVideosTrait; 
	use \App\Http\Traits\Gender\GenderAnnouncementTrait;
	use \App\Http\Traits\Gender\GenderCalendarTrait; 
	use \App\Http\Traits\Gender\GenderPlanandBudgetTrait; 
	use \App\Http\Traits\Gender\GenderAccomplishmentReportTrait; 
	use \App\Http\Traits\Gender\GenderNarrativeReportTrait; 
	use \App\Http\Traits\Gender\GenderMinutesMeetingTrait; 
	use \App\Http\Traits\Gender\GenderDownloadableFormTrait; 
	use \App\Http\Traits\Gender\GenderOtherReferenceTrait; 
}