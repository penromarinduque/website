<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class SideBarDetails extends Model
{
  
    protected $table = 'web_side_bar_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;
 
    public function parentClass()
    {
        return $this->belongsTo(SideBar::class, 'side_id', 'side_id');
    }
    
}
