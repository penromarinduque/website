<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class PanelDetailsInputText extends Model
{

    protected $table = 'web_panel_details_input_text';

    protected $primaryKey = 'text_id';

    public $timestamps = false;
    
}