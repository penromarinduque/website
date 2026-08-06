<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class PanelDetailsType extends Model
{

    protected $table = 'web_panel_details_type';

    protected $primaryKey = 'type_id';

    public $timestamps = false;
    
}