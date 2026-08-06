<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class MasterHead extends Model
{
  
    protected $table = 'web_master_head';

    protected $primaryKey = 'head_id';

    public $timestamps = false;
    
}
