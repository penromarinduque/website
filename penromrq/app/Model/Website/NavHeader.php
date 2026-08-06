<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class NavHeader extends Model
{
  
    protected $table = 'web_nav_header';

    protected $primaryKey = 'head_id';

    public $timestamps = false;

    public function subClass()
    {
    	return $this->hasMany(NavHeaderDetails::class,'head_id','head_id');
    }
    
}