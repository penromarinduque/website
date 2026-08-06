<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderFooterDetails extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'footer_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function footerInfo()
    {
    	return $this->belongsto(GenderFooter::class,'footer_id','footer_id');
    }

}