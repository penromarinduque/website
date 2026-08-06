<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
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
        $this->app->singleton('UsersAccountTrait', function () {
            return \App\Http\Traits\Accounts\UsersAccountTrait::class;
        });
        
        $this->app->singleton('UsersCompanyAccessTrait', function () {
            return \App\Http\Traits\Accounts\UsersCompanyAccessTrait::class;
        });

        $this->app->singleton('UsersInformationTrait', function () {
            return \App\Http\Traits\Accounts\UsersInformationTrait::class;
        });

        $this->app->singleton('UsersModuleAccessTrait', function () {
            return \App\Http\Traits\Accounts\UsersModuleAccessTrait::class;
        });

        $this->app->singleton('UsersSettingTrait', function () {
            return \App\Http\Traits\Accounts\UsersSettingTrait::class;
        });

        $this->app->singleton('UsersWindowAccessTrait', function () {
            return \App\Http\Traits\Accounts\UsersWindowAccessTrait::class;
        });
        
        $this->app->singleton('UsersWindowLoaderTrait', function () {
            return \App\Http\Traits\Accounts\UsersWindowLoaderTrait::class;
        });
        
        $this->app->singleton('UsersWindowMethodAccessTrait', function () {
            return \App\Http\Traits\Accounts\UsersWindowMethodAccessTrait::class;
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////       MODELS        ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////
        $this->app->singleton('Users', function () {
            return new \App\User;
        });

        $this->app->singleton('UsersAccount', function () {
            return new \App\User;
        });
       
        $this->app->singleton('UsersCompanyAccess', function () {
            return new \App\Model\Accounts\UsersCompanyAccess;
        });

        $this->app->singleton('UsersModuleAccess', function () {
            return new \App\Model\Accounts\UsersModuleAccess;
        });

        $this->app->singleton('UsersWindowAccess', function () {
            return new \App\Model\Accounts\UsersWindowAccess;
        });

        $this->app->singleton('UsersWindowMethodAccess', function () {
            return new \App\Model\Accounts\UsersWindowMethodAccess;
        });

    }

}
