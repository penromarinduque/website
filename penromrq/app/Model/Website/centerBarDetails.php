<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class CenterBarDetails extends Model
{
   
    protected $table = 'web_center_bar_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function parentClass()
    {
        return $this->belongsTo(CenterBar::class,'center_id','center_id');
    }

    public function navdetail()
    {
        return $this->hasOne(NavHeaderDetails::class,'nav_id','nav_details');
    }

    public function navmethod()
    {
        return $this->hasOne(NavHeaderMethod::class,'nav_id','nav_details');
    }

    public function otherimage()
    {
        return $this->hasMany(CenterBarVidImg::class,'detail_id','detail_id');
    }
    
}
