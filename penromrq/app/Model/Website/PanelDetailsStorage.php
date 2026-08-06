<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class PanelDetailsStorage extends Model
{

    protected $table = 'web_panel_details_storage';

    protected $primaryKey = 'storage_id';

    public $timestamps = false;
    
}