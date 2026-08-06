<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class NavHeaderMethod extends Model
{
  
    protected $table = 'web_nav_header_method';

    protected $primaryKey = 'method_id';

    public $timestamps = false;

    public function parentClass()
    {
        return $this->belongsTo(NavHeaderDetails::class,'nav_id','nav_id');
    }
    
}
