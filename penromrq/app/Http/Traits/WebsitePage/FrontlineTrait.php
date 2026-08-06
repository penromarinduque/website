<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait FrontlineTrait 
{

    public function admin_add_frontline($method, $id, $request)
    {
        $order_level = app('Frontline')->select('order_level')->orderBy('order_level','DESC')->first();

        $array = [
            'front_link' => $request->front_link,
            'front_text' => $request->front_text,
            'target_blank' => $request->target_blank,
            'order_level' => $order_level->order_level + 1,
            'status' => 0,
        ];

        $arrays = ($request->hasFile('front_image_path')) ? 

            Arr::add($array , 'front_image_path' ,$this->profileUpload($request,'front_image_path') ) : $array ;

        $created = app('Frontline')->insert($arrays);

        ($created) ? Session::flash('success','Frontline successfully created') : '' ;
    
        return back();
    }

    public function admin_edit_frontline($method, $id, $request)
    {
        $table = app('Frontline')->where('front_id',Crypt::decrypt($id));

        $exist = ($table->count() > 0) ? $table->first()->front_image_path : null ;

        $array = [
            'front_link' => $request->front_link,
            'front_text' => $request->front_text,
            'target_blank' => $request->target_blank,
            'order_level' => $request->order_level,
        ];

        $arrays = ($request->hasFile('front_image_path')) ? 
            Arr::add($array , 'front_image_path' ,$this->profileUpload($request,'front_image_path',$exist)) : $array ;

        $updated = $table->update($arrays);

        ($updated) ? Session::flash('success','Frontline successfully updated') : '' ;
    
        return back();
    }

    public function admin_toggle_frontline($method, $id, $request)
    {
        $result = app('Frontline')->where('status','1');

        if($result->count() <= 5)
        {
            app('Frontline')->where('front_id',Crypt::decrypt($id))->update(['status' => $request->status]);
        }

        return $result->count();
    }

    public function admin_delete_frontline($method, $id, $request)
    {
        $deleted = app('Frontline')->where('front_id', Crypt::decrypt($id))->delete();

        ($deleted) ? Session::flash('success','Frontline successfully deleted') : '' ;

        return back();
    }

}