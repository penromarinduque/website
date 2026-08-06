<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderHeaderDetails extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'header_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function headerInfo()
    {
    	return $this->belongsTo(GenderHeader::class,'head_id','head_id');
    }

}