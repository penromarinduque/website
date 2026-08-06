<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderFooter extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'footer';

    protected $primaryKey = 'footer_id';

    public $timestamps = false;

    public function footerDetailsInfo()
    {
    	return $this->hasMany(GenderFooterDetails::class,'footer_id','footer_id');
    }

}