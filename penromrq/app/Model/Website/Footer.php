<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
  
    protected $table = 'web_footer';

    public $timestamps = false;

    public function subClass()
    {
        return $this->hasMany(FooterDetails::class,'footer_id','footer_id')->orderBy('order_level','asc');
    }
    
}
