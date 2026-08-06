<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderCarouselSetupTrait
{

    public function gender_edit_carousel_group($method, $id, $request)
    {

        $CarouselGroup = app('GenderCarouselGroup')->where('group_id', decrypt($id))->first();

        if(count($CarouselGroup) > 0) {

            return $this->myViewMethodLoader($method)->with('group', $CarouselGroup);

        } else {

            Session::flash('failed','Carousel Group do not exists.');
            return back();

        }

    }

    // CAROUSEL GROUP 
    public function gender_create_carousel_group($method, $id, $request)
    {

        $this->validate($request, [
            'group_code' => 'required',
            'group_description' => 'required',
        ]);

        $model = app('GenderCarouselGroup');

        $array = [
            'group_code' => $request->group_code,
            'group_name' => $request->group_description,
            'order_level' => (new CommonService)->orderLevel($model),
            'created_by' =>  $this->thisUser()->users_id,
            'created_date' =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if( app('GenderCarouselGroup')->insert($array) ) {

            Session::flash('success', 'Carousel Group successfully created');
            return back();

        } else {

            Session::flash('failed', 'Something went wrong during the process, Please try again.');
            return back();

        }

    }

    public function gender_update_carousel_group($method, $id, $request)
    {

        $CarouselGroup = app('GenderCarouselGroup')->where('group_id', decrypt($id));

        if(count($CarouselGroup->first()) > 0) {
            
            $array = [
                'group_code' => $request->group_code,
                'group_name' => $request->group_description,
                'updated_by' =>  $this->thisUser()->users_id,
                'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
            ];

            if($CarouselGroup->update($array)) {

                Session::flash('success', 'Carousel Group successfully updated');
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

    public function gender_toggle_carousel_group($method, $id, $request)
    {
        return app('GenderCarouselGroup')->where('group_id', decrypt($id))->update(['status' => $request->status ]);
    }

    public function gender_delete_carousel_group($method, $id, $request)
    {
        $deleted = app('GenderCarouselGroup')->where('group_id', decrypt($id))->delete();

        Session::flash('success', 'Carousel Group successfully deleted!');

        return back();
    }
    
    // CAROUSEL GROUP DETAILS
    public function gender_create_carousel_group_details($method, $id, $request)
    {

        $model = app('GenderCarouselGrpDetails');

        $this->validate($request, [
            'group_id' => 'required',
            'carousel_text' => 'required',
            'carousel_link' => 'required',
            'carousel_button_text' => 'required',
            'carousel_path' => 'mimes:'.$this->validatefile('I'),
        ]);

        $carousel = [
            'group_id' => decrypt($request->group_id),
            'carousel_text' => $request->carousel_text,
            'carousel_button_text' => $request->carousel_button_text,
            'carousel_link' => $request->carousel_link,
            'order_level' => (new CommonService)->orderLevel($model),
            'created_by' =>  $this->thisUser()->users_id,
            'created_date' =>  (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if($request->hasFile('carousel_path')) 
        {

            $path = Storage::disk('gender')->putFile('carousel', $request->file('carousel_path'));

            $carousel = Arr::add($carousel,'carousel_path', $path);

        }

        if( app('GenderCarouselGrpDetails')->insert($carousel) ) {

            Session::flash('success', 'Carousel Group Details successfully created');
            return back();

        } else {

            Session::flash('failed', 'Something went wrong during the process, Please try again.');
            return back();

        }

    }

    public function gender_edit_carousel_group_details($method, $id, $request)
    {

        $CarouselGroupDetailsList = app('GenderCarouselGrpDetails')->orderBy('order_level','desc')->get();

        $CarouselGroupDetails = app('GenderCarouselGrpDetails')->where('carousel_id', decrypt($id))->first();

        if(count($CarouselGroupDetails) > 0) {

            return $this->myViewMethodLoader($method)
                                    ->with('group_details', $CarouselGroupDetails)
                                    ->with('carousel_group_details', $CarouselGroupDetailsList);

        } else {

            Session::flash('failed','Carousel Group Details do not exists.');
            return back();

        }

    }

    public function gender_update_carousel_group_details($method, $id, $request)
    {

        $this->validate($request, [
            'group_id' => 'required',
            'carousel_text' => 'required',
            'carousel_button_text' => 'required',
            'carousel_link' => 'required',
            'carousel_path' => 'mimes:'.$this->validatefile('I'),
        ]);

        $array = [
            'carousel_text' => $request->carousel_text,
            'carousel_button_text' => $request->carousel_button_text,
            'carousel_link' => $request->carousel_link,
            'updated_by' =>  $this->thisUser()->users_id,
            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        $CarouselGroupDetails = app('GenderCarouselGrpDetails')->where('carousel_id', decrypt($id));

        if(count($CarouselGroupDetails->first()) > 0) {

            if($request->hasFile('carousel_path')) {

                Storage::disk('gender')->delete($CarouselGroupDetails->first()->carousel_path);

                $path = Storage::disk('gender')->putFile('carousel', $request->file('carousel_path'));

                $array = Arr::add($array,'carousel_path', $path);

            }

            $CarouselGroupDetails->update($array);

            Session::flash('success', 'Carousel Group Details successfully updated');
            return back();

        } else {

            Session::flash('failed', 'Something went wrong during the update process, Please try again.');
            return back();

        }
    }

    public function gender_toggle_carousel_group_details($method, $id, $request)
    {
        return app('GenderCarouselGrpDetails')->where('carousel_id', decrypt($id))->update(['status' => $request->status ]);
    }

    public function gender_delete_carousel_group_details($method, $id, $request)
    {
        $deleted = app('GenderCarouselGrpDetails')->where('carousel_id', decrypt($id))->delete();

        Session::flash('success', 'Carousel Group Details successfully deleted!');
        return back();
    }
    
}
