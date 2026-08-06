<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class SideBar extends Model
{
  
    protected $table = 'web_side_bar';

    protected $primaryKey = 'side_id';
    
    public $timestamps = false;

    public function subClass()
    {
        return $this->hasMany(SideBarDetails::class,'side_id','side_id');
    }
    
}
