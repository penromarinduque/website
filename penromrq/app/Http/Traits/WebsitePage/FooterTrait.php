<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait FooterTrait 
{

    public function admin_add_footer_details($method, $id, $request)
    {
        $footer_order = app('FooterDetails')->where('footer_id', Crypt::decrypt($id))->orderBy('footer_order','DESC');

        $order_level = ($footer_order->count() > 0) ? $footer_order->first()->footer_order + 1 : 1 ;

        $array = [
            'footer_order' => $order_level,
            'footer_id' => Crypt::decrypt($id),
            'footer_path' => $request->footer_path,
            'footer_type' => $request->footer_type,
            'footer_tab' => $request->footer_tab
        ];

        if($request->hasFile('footer_text'))
        {

            $this->validate($request,[
                'footer_text' => 'mimes:'.$this->validatefile('I'),
            ]);

            $array = Arr::add($array, 'footer_text' , $this->profileUpload($request,'footer_text'));

        }else{

            $array = Arr::add($array, 'footer_text' , $request->footer_text );

        }

        $inserted = app('FooterDetails')->insert($array);

        ($inserted) ? Session::flash('success','Successfully Created') : '' ;
        
        return back();

    }

    public function admin_edit_footer_details($method, $id, $request)
    {
     
        $footer_order = app('FooterDetails')->where('detail_id', Crypt::decrypt($id));

        $array = [
            'footer_path' => $request->footer_path,
            'footer_type' => $request->footer_type,
            'footer_tab' => $request->footer_tab
        ];

        if($request->hasFile('footer_text'))
        {

            $this->validate($request,[
                'footer_text' => 'mimes:'.$this->validatefile('I'),
            ]);

            $array = Arr::add($array, 'footer_text' , $this->profileUpload($request,'footer_text'));

        }else{

            $array = Arr::add($array, 'footer_text' , $request->footer_text );

        }

        $updated = $footer_order->update($array);

        ($updated) ? Session::flash('success','Successfully Created') : '' ;
        
        return back();

    }

    public function admin_toggle_footer_details($method, $id, $request)
    {
        return app('FooterDetails')->where('detail_id',Crypt::decrypt($id))->update(['status' => $request->status]);
    }

    public function admin_delete_footer_details($method, $id, $request)
    {
        $deleted = app('FooterDetails')->where('detail_id',Crypt::decrypt($id))->delete();

        ($deleted) ? Session::flash('success','Successfully Deleted') : Session::flash('failed','Delete Unsuccessful') ;

        return $id;
    }

}