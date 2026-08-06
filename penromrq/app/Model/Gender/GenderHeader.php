<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderHeader extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'header';

    protected $primaryKey = 'head_id';

    public $timestamps = false;

    public function headerDetailsInfo()
    {
    	return $this->hasMany(GenderFooter::class,'head_id','head_id');
    }

}