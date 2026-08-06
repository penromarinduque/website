<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class FrontLine extends Model
{
  
    protected $table = 'web_frontline';

    protected $primaryKey = 'front_id';

    public $timestamps = false;
    
}
