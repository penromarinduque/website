<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPanelDetails extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'panel_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function panelInfo()
    {
    	return $this->belongsTo(GenderPanel::class,'panel_id','panel_id');
    }

}