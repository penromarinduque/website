<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderCarouselGrpDetails extends Model
{
	
    protected $connection = 'gender';
  
    protected $table = 'carousel_group_details';

    protected $primaryKey = 'carousel_id';

    public $timestamps = false;

    public function groupInfo()
    {
    	return $this->belongsTo(GenderCarouselGroup::class,'group_id','group_id');
    }

}