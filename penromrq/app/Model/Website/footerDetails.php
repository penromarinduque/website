<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class FooterDetails extends Model
{
  
    protected $table = 'web_footer_details';

    public $timestamps = false;
 
    public function parentClass()
    {
        return $this->belongsTo(Footer::class, 'footer_id', 'footer_id');
    }
    
}
