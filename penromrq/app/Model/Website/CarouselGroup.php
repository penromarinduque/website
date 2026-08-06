<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class CarouselGroup extends Model
{
  
    protected $table = 'web_carousel_group';

    protected $primaryKey = 'group_id';

    public $timestamps = false;

    public function subClass()
    {
    	return $this->hasMany(CarouselGroupDetails::class,'group_id','group_id');
    }
    
}