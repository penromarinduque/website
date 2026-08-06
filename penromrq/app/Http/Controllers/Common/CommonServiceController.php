<?php

namespace App\Http\Controllers\Common;

use Session;
use Carbon\Carbon;

class CommonServiceController
{

    public function dateTimeToday($format)
    {
        $dateTimeToday = Carbon::now();

        return $dateTimeToday->format($format);
    }

    public function orderLevel($model)
    {
        $collect = $model->select('order_level')->orderBy('order_level','desc')->first();
        
        return (!empty($collect)) ? $collect['order_level'] + 1 : 1 ;
    }
}
