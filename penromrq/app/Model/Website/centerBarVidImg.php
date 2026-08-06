<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class CenterBarVidImg extends Model
{
   
    protected $table = 'web_center_bar_image_video';

    public $timestamps = false;

    public function parentClass()
    {
        return $this->belongsTo(CenterBar::class, 'center_id', 'center_id');
    }
    
}
