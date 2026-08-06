<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class CarouselGroupDetails extends Model
{
  
    protected $table = 'web_carousel_group_details';

    protected $primaryKey = 'carousel_id';

    public $timestamps = false;

    public function parentClass()
    {
    	return $this->belongsTo(CarouselGroup::class,'group_id','group_id');
    }

}
