<?php

namespace App\Http\Traits\Common;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait SystemCommonSideBarTrait
{
	public function getActiveSideBar()
	{	
		return $this->systemWindowSub($this->usersWindowAccess(0));
	}

	protected function usersWindowAccess($parent)
	{
		return app('UsersWindowAccess')
							->where('module_to', $this->getModulePrefix()->module_id)
							->where('users_id', $this->thisUser()->users_id)
							->where('menu_parent', $parent)
							->where('status','1')
							->orderBy('order_level','asc')
							->get();
	}

	protected function systemWindowSub($array, $windows = []) 
	{

		foreach ($array as $key => $value) {

			$systemWindow = $value->systemWindow()->first();

			Arr::add($systemWindow, 'module_code', $this->activeModule);

			$setActive = ( $systemWindow['menu_path'] == $this->activePath) ? Arr::add($systemWindow, 'menu_active', 'active') : null ;

			$windowSubClass = $this->systemWindowSub($this->usersWindowAccess($value->menu_id));

			Arr::add($systemWindow,'menu_sub',$windowSubClass); 

			foreach($systemWindow['menu_sub'] as $checkactive) {

				( Arr::has($checkactive, 'menu_active') ) ? Arr::add($systemWindow, 'menu_active', 'active') : false ;

			}

			$windows[] = $systemWindow;
		}

		return collect($windows)->sortBy('order_level')->values();
	}
}