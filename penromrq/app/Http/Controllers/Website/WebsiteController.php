<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\WebsiteController as controller;

use App\Model\Website\NavHeaderDetails;
use App\Model\Layouts\panel;

class WebsiteController extends controller
{ 

    public function activenavbar($path = null, $action = null, $id = null, Request $request = null)
    {
        $checkpath = NavHeaderDetails::where('nav_path', $path);

        if ($checkpath->count() > 0 && !is_null($action) && !is_null($id)) {

            return $this->activemethod($action, $id, $checkpath->first(), $request);

        } else if ($checkpath->count() > 0 && is_null($action)) {

            $newbladedir = $checkpath->first()->nav_blade;

            if(\View::exists($newbladedir)){

                return view($newbladedir)
                        ->with('webdata', $this)
                        ->with('panel', $this->getpanelview($checkpath->first()->nav_id));

            } else {

                return $this->error404();

            }

        } else {

            return $this->error404();

        }

    }

    public function activemethod($action, $id, $checkpath, $request)
    {

        $checker = $checkpath->nav_method->where('nav_name', $action);

        if( $checker->count() > 0 ) {

            $method = ($checker->count() > 0) ? $checker->first() : ['nav_function' => ''];
        
            if (method_exists(app($method['nav_traits']), $method['nav_function'])) {

                $function = $method->nav_function;

                return $this->$function($method, $id, $checkpath, $request);

            } else {
                return $this->error404();
            }

        } else {
            return $this->error404();
        }
        
    }

    public function getpanelview($nav_id, $collect = [])
    {

        $panel = panel::where('panel_nav', $nav_id)->get();

        foreach ($panel as $key => $value) {

            $panel_details = $value->panel_details()->where('status','1')->get();

            $collect[] = Arr::add($value,'details', $this->checkmodeltoconnect($panel_details));

        }

        return $collect;

    }

    public function checkmodeltoconnect($array, $newArray = [])
    {

        foreach ($array as $key => $value) {

            if ($value->detail_type->type_code == 'STR') {
                Arr::add($value, 'storage', $value->storage()->get());
            }

            if ($value->detail_type->type_code == 'FRA') {
                Arr::add($value, 'frameset', $value->frameset()->get());
            }

            if ($value->detail_type->type_code == 'LON') {
                Arr::add($value, 'longtext', $value->longtext()->get());
            }

            if ($value->detail_type->type_code == 'TEX') {
                Arr::add($value, 'inputtext', $value->longtext()->get());
            }

        }

        return $array;

    }

    public function error404()
    {
        return view('errors.404');
    }
    
}
