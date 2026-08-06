<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPanel extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'panel';

    protected $primaryKey = 'panel_id';

    public $timestamps = false;

    public function navBarDetailsInfo()
    {
    	return $this->belongsTo(GenderNavBarDetails::class,'detail_id','detail_id');
    }

    public function panelDetailsInfo()
    {
    	return $this->hasMany(GenderPanelDetails::class,'panel_id','panel_id');
    }

}