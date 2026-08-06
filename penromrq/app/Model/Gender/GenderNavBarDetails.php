<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderNavBarDetails extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'nav_bar_details';

    protected $primaryKey = 'nav_id';

    public $timestamps = false;

    public function navBarInfo()
    {
    	return $this->belongsTo(GenderNavBar::class,'nav_id','nav_id');
    }

    public function navBarMethodsInfo()
    {
    	return $this->hasMany(GenderNavBarMethods::class,'detail_id','detail_id');
    }

    public function panelInfo()
    {
        return $this->hasMany(GenderPanel::class,'detail_id','detail_id');
    }

}