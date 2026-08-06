<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class CenterBar extends Model
{
   
    protected $table = 'web_center_bar';

    public $primaryKey = 'center_id';

    public $timestamps = false;

    public function subClass()
    {
        return $this->hasMany(CenterBarDetails::class, 'center_id', 'center_id')
                        ->orderBy('created_date','desc')
                        ->orderBy('detail_id','desc');
    }

    public function subClassVidImg()
    {
        return $this->hasMany(CenterBarVidImg::class, 'center_id', 'center_id')
                        ->orderBy('created_date','desc')
                        ->orderBy('order_level','desc')
                        ->orderBy('content_id','desc');
    }
    
}
