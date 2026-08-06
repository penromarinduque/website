<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait ModuleCommonAccessTrait
{
	public function getModulePrefix()
	{
		$activeModulePrefix = str_replace('/','',request()->route()->getPrefix());

		return app('SystemModule')->where('status','1')->where('module_prefix', $activeModulePrefix)->first();
	}

	/* SYSTEM MODULE GROUP */
	public function allModuleGroup($group = [])
	{
		$moduleGroup = app('SystemModuleGroup');

		return (count($group) > 0) ? $moduleGroup->whereIn('group_id', $group)->orderBy('order_level','asc')->get() : 

									 $moduleGroup->orderBy('order_level','asc')->get() ;

	}

	public function activeModuleGroup($group = null)
	{
		$moduleGroup = app('SystemModuleGroup')->where('status','1');

		return (!is_null($group)) ? $moduleGroup->where('group_id', $group)->first() : $moduleGroup->orderBy('order_level','asc')->get() ;
	}

	/* SYSTEM MODULE */
	public function allModule($modules = [])
	{
		$systemModule = app('SystemModule');

		return (count($modules) > 0) ? $systemModule->whereIn('module_id', $modules)->orderBy('order_level','asc')->get() : 

									   $systemModule->orderBy('order_level','asc')->get() ; 
	}

	public function activeModule($module = null)
	{
		$systemModule = app('SystemModule')->where('status','1');

		return (!is_null($module)) ? $systemModule->where('module_id', $module)->first() : $systemModule->get() ; 
	}
	
}