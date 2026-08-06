<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderNavBarMethods extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'nav_bar_methods';

    protected $primaryKey = 'method_id';

    public $timestamps = false;

    public function navBarDetailsInfo()
    {
    	return $this->belongsTo(GenderNavBarDetails::class,'detail_id','detail_id');
    }

}