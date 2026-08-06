<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class WebsiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       TRAITS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('WebsiteDashboardTrait', function () {
            return \App\Http\Traits\Website\WebsiteDashboardTrait::class;
        });

        $this->app->singleton('WebsitePageSetupTrait', function () {
            return \App\Http\Traits\Website\WebsitePageSetupTrait::class;
        });

        $this->app->singleton('WebsiteCenterPanelTrait', function () {
            return \App\Http\Traits\Website\WebsiteCenterPanelTrait::class;
        });

        $this->app->singleton('WebsiteFooterTrait', function () {
            return \App\Http\Traits\Website\WebsiteFooterTrait::class;
        });

        $this->app->singleton('WebsiteFrontlineTrait', function () {
            return \App\Http\Traits\Website\WebsiteFrontlineTrait::class;
        });

        $this->app->singleton('WebsiteCarouselTrait', function () {
            return \App\Http\Traits\Website\WebsiteCarouselTrait::class;
        });

        $this->app->singleton('WebsiteLayoutTrait', function () {
            return \App\Http\Traits\Website\WebsiteLayoutTrait::class;
        });

        $this->app->singleton('WebsiteMasterHeadTrait', function () {
            return \App\Http\Traits\Website\WebsiteMasterHeadTrait::class;
        });

        $this->app->singleton('WebsiteNavMenuTrait', function () {
            return \App\Http\Traits\Website\WebsiteNavMenuTrait::class;
        });

        $this->app->singleton('WebsiteNavigationTrait', function () {
            return \App\Http\Traits\Website\WebsiteNavigationTrait::class;
        });

        $this->app->singleton('WebsiteSidePanelTrait', function () {
            return \App\Http\Traits\Website\WebsiteSidePanelTrait::class;
        });

        $this->app->singleton('WebsiteSpecialTrait', function () {
            return \App\Http\Traits\Website\WebsiteSpecialTrait::class;
        });

        $this->app->singleton('WebsiteWindowLoaderTrait', function () {
            return \App\Http\Traits\Website\WebsiteWindowLoaderTrait::class;
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       MODELS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('NavHeader', function () {
            return new \App\Model\Website\NavHeader;
        });

        $this->app->singleton('NavHeaderDetails', function () {
            return new \App\Model\Website\NavHeaderDetails;
        });

        $this->app->singleton('NavHeaderMethod', function () {
            return new \App\Model\Website\NavHeaderMethod;
        });

        $this->app->singleton('MasterHead', function () {
            return new \App\Model\Website\MasterHead;
        });

        $this->app->singleton('CarouselGroup', function () {
            return new \App\Model\Website\CarouselGroup;
        });

        $this->app->singleton('CarouselGroupDetails', function () {
            return new \App\Model\Website\CarouselGroupDetails;
        });

        $this->app->singleton('Frontline', function () {
            return new \App\Model\Website\FrontLine;
        });

        $this->app->singleton('SideBar', function () {
            return new \App\Model\Website\SideBar;
        });

        $this->app->singleton('SideBarDetails', function () {
            return new \App\Model\Website\SideBarDetails;
        });

        $this->app->singleton('CenterBar', function () {
            return new \App\Model\Website\CenterBar;
        });

        $this->app->singleton('CenterBarDetails', function () {
            return new \App\Model\Website\CenterBarDetails;
        });

        $this->app->singleton('CenterBarVidImg', function () {
            return new \App\Model\Website\CenterBarVidImg;
        });

        $this->app->singleton('Footer', function () {
            return new \App\Model\Website\Footer;
        });

        $this->app->singleton('FooterDetails', function () {
            return new \App\Model\Website\FooterDetails;
        });

        $this->app->singleton('Panel', function () {
            return new \App\Model\Website\Panel;
        });

        $this->app->singleton('PanelDetails', function () {
            return new \App\Model\Website\PanelDetails;
        });

        $this->app->singleton('PanelDetailsFrameset', function () {
            return new \App\Model\Website\PanelDetailsFrameset;
        });

        $this->app->singleton('PanelDetailsInputText', function () {
            return new \App\Model\Website\PanelDetailsInputText;
        });

        $this->app->singleton('PanelDetailsLongText', function () {
            return new \App\Model\Website\PanelDetailsLongText;
        });

        $this->app->singleton('PanelDetailsStorage', function () {
            return new \App\Model\Website\PanelDetailsStorage;
        });

        $this->app->singleton('PanelDetailsType', function () {
            return new \App\Model\Website\PanelDetailsType;
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       WEBSITE        ///////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('CenterPanelTrait', function () {
            return \App\Http\Traits\WebsitepAGE\CenterPanelTrait::class;
        });
        $this->app->singleton('FooterTrait', function () {
            return \App\Http\Traits\WebsitepAGE\FooterTrait::class;
        });
        $this->app->singleton('FrontlineTrait', function () {
            return \App\Http\Traits\WebsitepAGE\FrontlineTrait::class;
        });
        $this->app->singleton('HeadCarouselTrait', function () {
            return \App\Http\Traits\WebsitepAGE\HeadCarouselTrait::class;
        });
        $this->app->singleton('LayoutTrait', function () {
            return \App\Http\Traits\WebsitepAGE\LayoutTrait::class;
        });
        $this->app->singleton('MasterHeadTrait', function () {
            return \App\Http\Traits\WebsitepAGE\MasterHeadTrait::class;
        });
        $this->app->singleton('NavMenuTrait', function () {
            return \App\Http\Traits\WebsitepAGE\NavMenuTrait::class;
        });
        $this->app->singleton('NavMenuMethodTrait', function () {
            return \App\Http\Traits\WebsitepAGE\NavMenuMethodTrait::class;
        });
        $this->app->singleton('SidePanelTrait', function () {
            return \App\Http\Traits\WebsitepAGE\SidePanelTrait::class;
        });
        $this->app->singleton('SpecialTrait', function () {
            return \App\Http\Traits\WebsitepAGE\SpecialTrait::class;
        });

    }
    
}
