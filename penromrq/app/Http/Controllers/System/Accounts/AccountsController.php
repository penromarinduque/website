<?php

namespace App\Http\Controllers\System\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/* NON VALIDATION TRAITS */
use App\Http\Traits\Accounts\UsersUpdatesTrait;

use App\Http\Traits\Accounts\UsersWindowLoaderTrait;
use App\Http\Traits\Accounts\UsersModuleAccessTrait;
use App\Http\Traits\Accounts\UsersWindowAccessTrait;
use App\Http\Traits\Accounts\UsersCompanyAccessTrait;

class AccountsController extends Controller 
{
	use UsersWindowLoaderTrait, UsersModuleAccessTrait, UsersCompanyAccessTrait, UsersWindowAccessTrait, UsersUpdatesTrait;
}