<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderNavigationSetupTrait
{

    public function gender_edit_navigation_group($method, $id, $request)
    {

        $NavigationGroup = app('GenderNavBar')->where('nav_id', decrypt($id))->first();

        if(count($NavigationGroup) > 0) {

            return $this->myViewMethodLoader($method)
                        ->with('group', $NavigationGroup);

        } else {

            Session::flash('failed','Carousel Group do not exists.');
            return back();

        }

    }

    public function gender_edit_navigation_group_details($method, $id, $request)
    {

        $GenderNavBarDetails = app('GenderNavBarDetails')->where('detail_id', decrypt($id))->first();

        if(count($GenderNavBarDetails) > 0) {

            return $this->myViewMethodLoader($method)
                        ->with('group_details', $GenderNavBarDetails);

        } else {

            Session::flash('failed','Carousel Group Details do not exists.');
            return back();

        }

    }
    // CAROUSEL GROUP 
    public function gender_create_navigation_group($method, $id, $request)
    {

        $this->validate($request, [
            'group_image' => 'mimes:'.$this->validatefile('I'),
            'group_code' => 'required',
            'group_description' => 'required',
        ]);

        $model = app('GenderNavBar');

        $array = [
            'nav_logo_path' => $this->profileUpload($request,'group_image'),
            'nav_logo_text' => $request->group_code,
            'nav_description' => $request->group_description,
            'order_level' => (new CommonService)->orderLevel($model),
            'created_by' =>  $this->thisUser()->users_id,
            'created_date' =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if( app('GenderNavBar')->insert($array) ) {

            Session::flash('success', 'Navigation Group successfully created');
            return back();

        } else {

            Session::flash('failed', 'Something went wrong during the process, Please try again.');
            return back();

        }

    }

    public function gender_update_navigation_group($method, $id, $request)
    {

        $CarouselGroup = app('GenderNavBar')->where('nav_id', decrypt($id));

        if(count($CarouselGroup->first()) > 0) {

            $this->validate($request, [
                'group_image' => 'mimes:'.$this->validatefile('I'),
                'group_code' => 'required',
                'group_description' => 'required',
            ]);
            
            $array = [
                'nav_logo_text' => $request->group_code,
                'nav_description' => $request->group_description,
                'updated_by' =>  $this->thisUser()->users_id,
                'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
            ];

            if($request->hasFile('group_image')) {
                $array = Arr::add($array, ['nav_logo_path' => $this->profileUpload($request, 'group_image', $CarouselGroup->firs()['nav_logo_path'])]);
            }

            if($CarouselGroup->update($array)) {

                Session::flash('success', 'Navigation Group successfully updated');
                return back();

            } else {

                Session::flash('failed', 'Something went wrong during the process, Please try again.');
                return back();

            }

        } else {

            Session::flash('failed', 'Something went wrong during the process, Please try again.');
            return back();

        }

    }

    public function gender_toggle_navigation_group($method, $id, $request)
    {
        return app('GenderNavBar')->where('nav_id', decrypt($id))->update(['status' => $request->status ]);
    }

    public function gender_delete_navigation_group($method, $id, $request)
    {
        $deleted = app('GenderNavBar')->where('nav_id', decrypt($id))->delete();

        Session::flash('success', 'Navigation Group successfully deleted!');

        return redirect(route('gender.route',['path' => 'navigation-group']));
    }

    // CAROUSEL GROUP DETAILS
    public function gender_create_navigation_group_details($method, $id, $request)
    {

        $model = app('GenderNavBarDetails');

        $this->validate($request, [
            'group_id' => 'required',
            'detail_parent' => 'required',
            'detail_description' => 'required',
            'detail_path' => 'required',
            'detail_blade' => 'required',
            'detail_link' => 'required',
            'detail_type' => 'required',
        ]);

        $array = [
            'nav_id' => decrypt($request->group_id),
            'detail_level' => $request->detail_level,
            'detail_parent' => $request->detail_parent,
            'detail_name' => $request->detail_description,
            'detail_path' => $request->detail_path,
            'detail_blade' => 'pages.website.gender.'.strtolower($request->detail_blade),
            'detail_link' => strtolower($request->detail_link),
            'order_level' => (new CommonService)->orderLevel($model),
            'created_by' =>  $this->thisUser()->users_id,
            'created_date' =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if( app('GenderNavBarDetails')->insert($array) ) {

            Session::flash('success', 'Navigation Group Details successfully created');
            return back();

        } else {

            Session::flash('failed', 'Something went wrong during the process, Please try again.');
            return back();

        }

    }

    public function gender_update_navigation_group_details($method, $id, $request)
    {

        $this->validate($request, [
            'group_id' => 'required',
            'detail_parent' => 'required',
            'detail_description' => 'required',
            'detail_path' => 'required',
            'detail_blade' => 'required',
            'detail_link' => 'required',
        ]);

        $array = [
            'nav_id' => decrypt($request->group_id),
            'detail_level' => $request->detail_level,
            'detail_parent' => $request->detail_parent,
            'detail_name' => $request->detail_description,
            'detail_path' => $request->detail_path,
            'detail_blade' => 'pages.website.gender.'.strtolower($request->detail_blade),
            'detail_link' => strtolower($request->detail_link),
            'updated_by' =>  $this->thisUser()->users_id,
            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];
     
        $NavigationGroupDetails = app('GenderNavBarDetails')->where('detail_id', decrypt($id));

        if ($NavigationGroupDetails->count() > 0) {

            $NavigationGroupDetails->update($array);

            Session::flash('success', 'Navigation Group Details successfully updated');
            return back();

        } else {

            Session::flash('failed', 'Something went wrong during the update process, Please try again.');
            return back();

        }
    }

    public function gender_toggle_navigation_group_details_tab($method, $id, $request)
    {
        return app('GenderNavBarDetails')->where('detail_id', decrypt($id))->update(['detail_tab' => $request->status ]);
    }

    public function gender_toggle_navigation_group_details_type($method, $id, $request)
    {
        return app('GenderNavBarDetails')->where('detail_id', decrypt($id))->update(['detail_type' => $request->status ]);
    }

    public function gender_toggle_navigation_group_details($method, $id, $request)
    {
        return app('GenderNavBarDetails')->where('detail_id', decrypt($id))->update(['status' => $request->status ]);
    }

    public function gender_delete_navigation_group_details($method, $id, $request)
    {
        $deleted = app('GenderNavBarDetails')->where('detail_id', decrypt($id))->delete();

        Session::flash('success', 'Navigation Group Details successfully deleted!');

        return redirect(route('gender.route', ['path' => 'navigation-group-details']));
    }
}
