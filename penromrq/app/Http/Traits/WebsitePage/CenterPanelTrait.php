<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait CenterPanelTrait
{
    /*
     * FOR VIEWING DATA
     */
    public function admin_view_edit_news_and_articles($method, $id, $request)
    {

        $details = $this->center_details(Crypt::decrypt($id));

        if(count($details->first()) > 0) 
        {
            return (new CommonService)->view_blade($method)->with('center', $details->first()); 
        } 
            else 
        {
            Session::flash('success', 'File is already deleted');
            return redirect('/admin/center-panel-setup?events');
        }

    }

    public function admin_view_edit_image_and_video($method, $id, $request)
    {

        $details = $this->center_image_video(Crypt::decrypt($id));

        return (new CommonService)->view_blade($method)->with('center', $details);

    }

    public function admin_view_add_center_panel($method, $id, $request)
    {

        $details = $this->center(Crypt::decrypt($id));

        return (new CommonService)->view_blade($method)->with('center', $details);

    }

    public function admin_add_news_and_articles($method, $id, $request, $otherimage = [])
    {
        /* CHECK FILE IF VALID */
        $this->my_file_checker($request);

        $array = [
            'center_id' => Crypt::decrypt($id),
            'created_title' => $request->created_title,
            'created_story' => $request->wysihtml5,
            'published_by' => $request->create_by,
            'published_date' => $request->create_date,
            'created_by' => $this->thisUser()->id,
            'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        $otherimages = [
            'center_id' => Crypt::decrypt($id),
            'vid_img_flag' => 'I',
            'published_by' => $request->create_by,
            'published_date' => $request->create_date,
            'created_by' => $this->thisUser()->id,
            'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if ($request->hasFile('image1')) {
            $array = Arr::add($array, 'created_image', $this->profileUpload($request, 'image1'));
        }

        $lastInsertId = app('CenterBarDetails')->insertGetId($array);

        $otherimages = Arr::add($otherimages, 'detail_id', $lastInsertId);

        if ($request->hasFile('image2')) {
            $this->createadditionalimage(2, $otherimages);
        }

        if ($request->hasFile('image3')) {
            $this->createadditionalimage(3, $otherimages);
        }
 
        Session::flash('success', 'Successfully Created');

        return back();
        
    }
 
    public function admin_add_center_panel_image_video($method, $id, $request)
    {
        $this->my_file_checker($request);
           
        $array = [
            'center_id' => Crypt::decrypt($id),
            'vid_img_embed' => $request->wysihtml5,
            'vid_img_link' => $request->link,
            'vid_img_title' => $request->created_title,
            'vid_img_flag' => $request->vid_img_flag,
            'published_by' => $request->create_by,
            'published_date' => $request->create_date,
            'created_by' => $this->thisUser()->id,
            'created_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if(!is_null($request->link)) {
            if($request->vid_img_flag == 'V') {
                if($this->validate_link_for_youtube($request->link)->status) {
                    $array = Arr::add($array, 'vid_img_path', $this->validate_link_for_youtube($request->link)->result);
                } else {
                    Session::flash('failed', $this->validate_link_for_youtube($request->link)->result);
                    return back()->withInput();
                }
            } else {
                $array = Arr::add($array, 'vid_img_path', $this->profileUpload($request, 'image'));
            }
        }

        $created = app('CenterBarVidImg')->insert($array);
        ($created) ? Session::flash('success', 'Successfully created') :
        Session::flash('failed', 'Something went wrong, Please try again') ;
        return back();
    }

    public function validate_link_for_youtube($youtube) {

        $errors = new \stdClass;

        parse_str( parse_url( $youtube, PHP_URL_QUERY ), $my_array_of_vars );

        if(collect($my_array_of_vars)->isNotEmpty()) {
            if(array_key_exists('v', $my_array_of_vars)) {
                $vid_img_link = $my_array_of_vars['v'];
                $errors->status = true;
                $errors->result = 'https://img.youtube.com/vi/' . $vid_img_link . '/hqdefault.jpg';
            } else {
                $errors->status = false;
                $errors->result = 'Cannot find (YouTube Video ID) on this URL. Please try another one';
            } 
        } else {
            $errors->status = false;
            $errors->result = 'Youtube url is not valid. ex:(https://www.youtube.com/watch?v=<= YOUTUBE VIDEO ID =>)';
        } 

        return $errors;

    }

    public function createadditionalimage($int, $array)
    {
        $array = Arr::add($array, 'vid_img_path', $this->profileUpload(request(), 'image'.$int));

        $array = Arr::add($array, 'order_level', $int);

        $array = Arr::add($array, 'vid_img_title', 'image'.$int);
         
        app('CenterBarVidImg')->insert($array);
    }

    public function checkimagevideo($int, $details, $array)
    {
        $orderlevel = $details->where('order_level', $int);

        if (collect($orderlevel->first())->isNotEmpty()) {
            if ($orderlevel->first()['order_level'] == $int) {
                // update if exists
                $updateimage = ['vid_img_path' => $this->profileUpload(request(), 'image'.$int, $orderlevel->first()['vid_img_path']) ];

                $orderlevel->where('order_level', $int)->update($updateimage);
            }
        } else {
            $this->createadditionalimage($int, $array);
        }
    }
 
    public function admin_toggle_centerpanel_details($method, $id, $request)
    {
        return app('CenterBarDetails')->where('detail_id', Crypt::decrypt($id))->update(['status' => $request->status]);
    }

    public function admin_toggle_centerpanel_details_detail($method, $id, $request)
    {
        return app('CenterBarVidImg')->where('content_id', Crypt::decrypt($id))->update(['status' => $request->status]);
    }
    /*
     * FOR DELETEING DATA
     */
    public function admin_delete_center_panel_details($method, $id, $request)
    {
        $this->delete_image_video(Crypt::decrypt($id));

        $this->delete_center_details(Crypt::decrypt($id));

        Session::flash('success', 'Successfully deleted');

        return back();
    }

    public function admin_delete_center_panel_image_video($method, $id, $request)
    {
        $this->delete_image_video(Crypt::decrypt($id));

        Session::flash('success', 'Successfully deleted');
        
        return back();
    }

    public function delete_image_video($id)
    {
        return app('CenterBarVidImg')->where('content_id', $id)->delete();
    }

    public function delete_center_details($id)
    {
        return app('CenterBarDetails')->where('detail_id', $id)->delete();
    }

    /*
     * FOR UPDATING DATA
     * POST REQUEST 
     * 
     * Included */
    public function admin_edit_news_and_articles($method, $id, $request)
    {
        $this->my_file_checker($request);

        $this->update_centerpanel_details($request); 

        $this->update_centerpanel_imagevideo($request);
    
        Session::flash('success', 'Successfully updated');
    
        return back();
    }

    public function update_centerpanel_details($request)
    {
        $details = app('CenterBarDetails')->where('detail_id', Crypt::decrypt($request->detail_id));

        $array = [
            'created_title' => $request->created_title,
            'created_story' => $request->wysihtml5,
            'published_by' => $request->published_by,
            'published_date' => $request->published_date,
            'updated_by' => $this->thisUser()->id,
            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        if ($details->count() > 0) {
            if ($request->hasFile('image1')) {
                $array = Arr::add($array, 'created_image', $this->profileUpload($request, 'image1', $details->first()['created_image']));
            }
        }

        return $details->update($array);
    }

    public function update_centerpanel_imagevideo($request)
    {
        $detail_id = Crypt::decrypt($request->detail_id);
        $center_id = Crypt::decrypt($request->center_id);

        $array = [
            'detail_id' => $detail_id,
            'center_id' => $center_id,
            'vid_img_flag' => 'I',
            'published_by' => $request->published_by,
            'published_date' => $request->published_date,
            'updated_by' => $this->thisUser()->id,
            'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        $otherimage = $this->center_details(Crypt::decrypt($request->detail_id))->first();

        if ($otherimage->otherimage()->count() > 0) {
            if ($request->hasFile('image2')) {
                $this->checkimagevideo(2, $otherimage->otherimage(), $array);
            }

            if ($request->hasFile('image3')) {
                $this->checkimagevideo(3, $otherimage->otherimage(), $array);
            }
        } else {
            
            if ($request->hasFile('image2')) {
                $this->createadditionalimage(2, $array);
            }

            if ($request->hasFile('image3')) {
                $this->createadditionalimage(3, $array);
            }
        }
    }

    public function admin_edit_center_panel_image_video($method, $id, $request)
    {

        $array = [
           'vid_img_embed' => $request->wysihtml5,
           'vid_img_link' => $request->link,
           'vid_img_title' => $request->created_title,
           'vid_img_flag' => $request->vid_img_flag,
           'published_by' => $request->published_by,
           'published_date' => $request->published_date,
           'updated_by' => $this->thisUser()->id,
           'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s'),
        ];

        $validate = app('CenterBarVidImg')->where('content_id', Crypt::decrypt($id));

        if ($validate->count() > 0) {
            if(!is_null($request->link)) {
                if($request->vid_img_flag == 'V') {
                    if($this->validate_link_for_youtube($request->link)->status) {
                        if ($request->hasFile('image')) {
                            $array = Arr::add($array, 'vid_img_path', $this->profileUpload($request, 'image', $validate->first()['vid_img_path']));
                        }
                    } else {
                        Session::flash('failed', $this->validate_link_for_youtube($request->link)->result);
                        return back()->withInput();
                    }
                } else {
                    if ($request->hasFile('image')) {
                        $array = Arr::add($array, 'vid_img_path', $this->profileUpload($request, 'image', $validate->first()['vid_img_path']));
                    }
                }
            }
        }
       
        $updated = $validate->update($array);
        ($updated) ? Session::flash('success', 'Successfully updated') :
        Session::failed('failed', 'Something went wrong, Please try again') ;
        return back();

    }

    public function admin_delete_center_panel_image_path($method, $id, $request)
    {

        if ( $request->type == 0 ) {

            // $centerDetails = app('CenterBarDetails')->where('detail_id',$request->image_id);

            // if ( $centerDetails->count() > 0 ) {

                // $getImage = $centerDetails->first();

                // if ( (new Filesystem)->exists($getImage['created_image']) ) {
                  
                //     if( (new Filesystem)->delete([$getImage['created_image']]) ) {
                //         $centerDetails->update(['created_image' => 'web/images/placeholder.png']);
                //     }
                // }
            // }

        } else if ( $request->type == 1 ) {

            app('CenterBarVidImg')->where('content_id',$request->image_id)->update([
                'detail_id' => 0,
                'updated_by' => $this->thisUser()->id,
                'updated_date' => (new CommonService)->dateTimeToday('Y-m-d h:i:s')
            ]);

        }

    }
}
