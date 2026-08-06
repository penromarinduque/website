<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderCarouselGroup extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'carousel_group';

    protected $primaryKey = 'group_id';
    
    public $timestamps = false;

    public function groupDetailsInfo()
    {
    	return $this->hasMany(GenderCarouselGrpDetails::class,'group_id','group_id');
    }

}