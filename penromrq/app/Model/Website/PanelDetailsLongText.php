<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class PanelDetailsLongText extends Model
{

    protected $table = 'web_panel_details_long_text';

    protected $primaryKey = 'text_id';

    public $timestamps = false;
    
}