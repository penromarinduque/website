<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderNavBar extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'nav_bar';

    protected $primaryKey = 'nav_id';

    public $timestamps = false;

    public function navBarDetailsInfo()
    {
    	return $this->hasMany(GenderNavBarDetails::class,'nav_id','nav_id');
    }

}