<?php

namespace App\Http\Traits\WebsitePage;

use Crypt;
use Session;
use Illuminate\Http\Request;

trait NavMenuGenerateTrait
{
    public function getNavHeader($path = null, $id = null)
    {
        $array = app('NavHeaderDetails')->where([ [ 'status' , 1 ] , [ 'nav_parent' , 0 ] ]);
       
        $array = $array->with(['nav_sub' =>
            function ($query) use ($path) {

                // $query->where('nav_link', $this->usersActiveModule());

                if (!is_null($path)) {
                    return $query->where('nav_path', $path);
                }
                
            }
      	])->orderBy('order_level', 'ASC');

        if (!is_null($id)) {
            $array = $array->where('head_id', $id);
        }

        return $array->get();
    }
}
