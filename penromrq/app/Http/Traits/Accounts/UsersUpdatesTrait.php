<?php

namespace App\Http\Traits\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait UsersUpdatesTrait
{
	public function updateUsersCompany(Request $request)
	{
		return app('Users')->where('users_id', $this->thisUser()->users_id)->update([
			'company_id' => $request->company_id
		]);
	}
}