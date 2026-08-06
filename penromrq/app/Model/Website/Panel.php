<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{

    protected $table = 'web_panel';

    public $timestamps = false;

    public $primaryKey = 'panel_id';

    public function panelDetailsInfo()
    {
    	return $this->hasMany(PanelDetails::class,'panel_dtl_parent_id','panel_id');
    }
    
}
