<?php

namespace App\Http\Traits\Website;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait WebsiteFrontlineTrait 
{

    protected function website_frontline_data()
    {
        return app('Frontline')->get();
    }

    public function admin_add_frontline($method, $id, $request)
    {

        $frontline = app('Frontline');

        $array = [
            'front_link'  => $request->front_link,
            'front_text'  => $request->front_text,
            'front_tab'   => $request->target_blank,
            'order_level' => (new CommonService)->orderLevel($frontline),
        ];

        if($request->hasFile('front_image_path')) {

            $array = Arr::add($array, 'front_image_path', $this->profileUpload($request, 'front_image_path'));

        } 

        $frontline->insert($array);

        Session::flash('success','Frontline successfully created');
    
        return back();

    }

    public function admin_edit_frontline($method, $id, $request)
    {

        $table = app('Frontline')->where('front_id', decrypt($id));

        $exist = ($table->count() > 0) ? $table->first()->front_image_path : null ;

        $array = [
            'front_tab'   => $request->target_blank,
            'front_link'  => $request->front_link,
            'front_text'  => $request->front_text,
            'order_level' => $request->order_level,
        ];

        $arrays = ($request->hasFile('front_image_path')) ? 
            Arr::add($array , 'front_image_path' ,$this->profileUpload($request,'front_image_path', $exist)) : $array ;

        $updated = $table->update($arrays);

        ($updated) ? Session::flash('success','Frontline successfully updated') : '' ;
    
        return back();
    }

    public function admin_toggle_frontline($method, $id, $request)
    {
        $result = app('Frontline')->where('status', '1');

        if($result->count() <= 5) {
            app('Frontline')->where('front_id', decrypt($id))->update(['status' => $request->status]);
        }
        
        return $result->count();
    }

    public function admin_delete_frontline($method, $id, $request)
    {
        $deleted = app('Frontline')->where('front_id',  decrypt($id))->delete();

        ($deleted) ? Session::flash('success','Frontline successfully deleted') : '' ;

        return back();
    }

}