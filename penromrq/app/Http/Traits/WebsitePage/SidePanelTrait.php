<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait SidePanelTrait
{
    public function admin_view_side_panel($method, $id, $request)
    {
        return 'admin view side panel setup';
    }

    public function admin_add_side_panel($method, $id, $request)
    {

        $array = [
            'side_panel_type' => $request->panel_side,
            'side_panel_title' =>  $request->panel_title,
            'side_panel_flag' => $request->panel_type,
        ];

        $created = app('SideBar')->insert($array);

        ( $created ) ? Session::flash('success', 'Success') : '' ;

        return back();
        
    }

    public function admin_update_side_panel($method, $id, $request)
    {
       
        $array = [
            'side_panel_type' =>$request->panel_side,
            'side_panel_title' => $request->panel_title,
            'side_panel_flag' => $request->panel_type,
            'order_level' => $request->panel_order,
        ];

        $updated = app('SideBar')->where('side_id',Crypt::decrypt($id))->update($array);

        ( $updated ) ? Session::flash('success', 'update') : '' ;

        return back();

    }

    public function admin_delete_side_panel($method, $id, $request)
    {
        app('SideBar')->where('side_id',Crypt::decrypt($request->id))->delete();

        return Crypt::decrypt($request->id);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////// PANEL DETAILS ////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function admin_add_side_panel_detail($method, $id, $request)
    {   
   
        $array = [
            'side_id' => Crypt::decrypt($request->side_id),
            'detail_flag' => $request->type,
            'detail_link' => $request->left_link,
            'detail_text' => $request->left_text,
            'frame_type' => $request->frame_type,
        ];

        $array = [
            'side_id' => Crypt::decrypt($request->side_id),
            'detail_flag' => $request->type, /* image or frame */
            'detail_text' => $request->text, /* Description */
        ];

        if($request->type == 'F'){

            $array = Arr::add($array , 'detail_path', $request->frameset);

        }else if($request->type == 'I'){

            $array = Arr::add($array , 'detail_link', $request->link);

            if($request->hasFile('image'))
            {
                $array = Arr::add($array , 'detail_path', $this->profileUpload($request,'image'));
            }

        }

        $created = app('SideBarDetails')->insert($array);

        ( $created ) ? Session::flash('success', 'created') : '' ;

        return back();

    }

    public function admin_update_side_panel_detail($method, $id, $request)
    {
      
        $table = app('SideBarDetails')->where('detail_id',Crypt::decrypt($request->detail_id));

        $array = [
            'detail_flag' => $request->type,
            'detail_text' => $request->text,
        ];

        if($request->type == 'F'){

            $array = Arr::add($array , 'detail_path', $request->frameset);

        }else if($request->type == 'I'){

            $filename = $table->first()->detail_path;

            $array = Arr::add($array , 'detail_link', $request->link);

            if($request->hasFile('image'))
            {
                $array = Arr::add($array , 'detail_path', $this->profileUpload($request,'image', $filename));
            }

        }

        $updated = $table->update($array);

        ( $updated ) ? Session::flash('success', 'Side Panel successfully updated.') : '' ;

        return back();

    }

    public function admin_delete_side_panel_detail($method, $id, $request)
    {

        app('SideBarDetails')->where('detail_id',Crypt::decrypt($request->id))->delete();

        return Crypt::decrypt($request->id);

    }

}
