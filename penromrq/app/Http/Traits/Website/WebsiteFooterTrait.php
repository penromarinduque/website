<?php

namespace App\Http\Traits\Website;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait WebsiteFooterTrait 
{

    protected function website_footer_data($type)
    {
        return app('Footer')->where('footer_row', $type)->where('status', '1')
                    ->orderBy('order_level', 'asc')
                    ->has('subClass')->with('subClass')
                    ->get();
    }

    public function admin_add_footer_details($method, $id, $request)
    {

        $footer = app('FooterDetails');

        $array = [
            'footer_id'    => decrypt($id),
            'footer_tab'   => $request->footer_tab,
            'footer_path'  => $request->footer_path,
            'footer_type'  => $request->footer_type,
            'footer_order' => (new CommonService)->orderLevel($footer)
        ];

        if($request->hasFile('footer_text')) {

            $this->validate($request,[
                'footer_text' => 'mimes:'.$this->validatefile('I'),
            ]);

            $array = Arr::add($array, 'footer_text' , $this->profileUpload($request,'footer_text'));

        } else {

            $array = Arr::add($array, 'footer_text' , $request->footer_text);

        }

        app('FooterDetails')->insert($array);

        Session::flash('success','Footer successfully created');
        
        return back();

    }

    public function admin_edit_footer_details($method, $id, $request)
    {
     
        $footer = app('FooterDetails')->where('detail_id', decrypt($id));

        $array = [
            'footer_path' => $request->footer_path,
            'footer_type' => $request->footer_type,
            'footer_tab' => $request->footer_tab
        ];

        if($request->hasFile('footer_text')) {

            $this->validate($request,[
                'footer_text' => 'mimes:'.$this->validatefile('I'),
            ]);

            $array = Arr::add($array, 'footer_text' , $this->profileUpload($request,'footer_text'));

        } else {

            $array = Arr::add($array, 'footer_text' , $request->footer_text );

        }

        $footer->update($array);

        Session::flash('success','Footer update successfully');
        
        return back();

    }

    public function admin_toggle_footer_details($method, $id, $request)
    {
        return app('FooterDetails')->where('detail_id', decrypt($id))->update(['status' => $request->status]);
    }

    public function admin_delete_footer_details($method, $id, $request)
    {
        app('FooterDetails')->where('detail_id', decrypt($id))->delete();

        Session::flash('success','Footer deleted successfully');
    }

}