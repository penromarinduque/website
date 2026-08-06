<?php 

namespace App\Http\Traits\Accounts;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait UsersAccountTrait
{

	public function accounts_users_rules()
	{
		return [
			'profile_photo' => 'mimes:' . $this->validatefile('I'),
	        'password' => 'min:6|required_with:cpassword|same:cpassword',
	        'cpassword' => 'min:6',
	        'contact' => 'min:10',
		];
	}
	
	public function accounts_create_users($method, $id = null, $request)
	{
		$rules = $this->accounts_users_rules();

		$validate = $this->validate($request, $rules);
	
		$toUsers = [
			'company_id' => $request->company,
	        'firstname' => $request->firstname,
	        'middlename' => $request->middlename,
	        'lastname' => $request->lastname,
	        'email' => $request->email,
	        'birthdate' => $request->birth_date,
	        'education' => $request->education,
	        'position_title' => $request->position_title,
	        'contact' => $request->contact_no,
	        'address' => $request->address,
	        'username' => $request->username,
	        'password' => bcrypt($request->password),
	        'age' => ((new CommonService)->dateTimeToday('Y') - date('Y', strtotime($request->birth_date))),
	        'order_level' => (new CommonService)->orderLevel(app('Users')),
	        'created_by' => $this->thisUser()->users_id,
	        'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	        'profile_path' => $this->profileUpload($request,'profile_photo'),
		];

		/* VALIDATE USERS IF EXISTS */
		$user = app('Users')->where('firstname', $request->firstname)
							->where('lastname', $request->lastname)
		                    ->where('username', $request->username)
		                    ->where('email', $request->email)
		                    ->first();

		/* VALIDATE COMPANY IF MAX USERS EXCEEDS */
		$company = app('SystemCompany')->where('company_id', $request->company )->first();
		
		if(count($this->allUsersPerCompany($request->company)) >= $company->company_system_users) 
		{
		    $message ='Cannot add new user. This company (' . $company->company_descriptiion . ') reached the maximum number of users.';

		    Session::flash('failed', $message);
		    return back()->withInput();
		}

		if(!empty($user)) {
		    Session::flash('failed','This user is already exists.');
		    return back()->withInput();
		} else {
		    app('Users')->insert($array);

		    Session::flash('success','New System User is successfully created.');
		    return back();
		}
	}

	public function accounts_update_users_info($method, $id, $request)
	{
	    $array = $request->except('_token', 'userid');

	    $array = Arr::add($array, 'updated_by', $this->thisUser()->users_id);

	    $updated = app('Users')->where('users_id', decrypt($request->userid))->update($array);

	    Session::flash('success', 'Users Account Information successfully updated.');
	    return back();
	}

	public function accounts_update_users_profile_photo($method, $id, $request)
	{
	    if ($request->hasFile('change_profile')) {

	    	$this->validate($request, [
	    		'change_profile' => 'mimes' . $this->validatefile('I'),
	    	]);

	        $image_path = $this->profileUpload($request, 'change_profile', $this->getUser($id)->profile_path);

	        app('Users')->where('users_id', decrypt($id))->update(['profile_path' => $image_path]);

	        Session::flash('success', 'Profile picture updated successfully.');
	    	return back();

	    } else {
	    	Session::flash('failed', 'Please select your profile Photo.');
	    	return back();
	    }
	}

	public function accounts_update_users_password($method, $id, $request)
	{
	    if (Hash::check($request->opassword, $this->getThisUser($request->userid)->password)) {
	        if ($request->npassword == $request->cpassword) {

	            $users->update(['password' => bcrypt($request->cpassword) ]);

	            Session::flash('success', 'Password updated successfully.');
	            return back();

	        } else {
	            Session::flash('failed', 'Password do not match with the confirmed password, Please try again');
	            return back();
	        }
	    } else {
	        Session::flash('failed', 'You have enterred Incorrect old password');
	        return back();
	    }
	}

	public function accounts_toggle_users_account($method, $id = null, $request)
	{
	    if($this->thisUser()->users_id != decrypt($id)) {
	        app('Users')->where('users_id', decrypt($id))->update([
	            'status' => $request->status,
	            'updated_by' => $this->thisUser()->users_id,
	            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
	        ]);
	    } 
	}

	public function accounts_delete_users($method, $id = null, $request)
	{
		
	}

}