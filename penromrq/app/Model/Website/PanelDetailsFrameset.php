<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class PanelDetailsFrameset extends Model
{

    protected $table = 'web_panel_details_frameset';

    protected $primaryKey = 'frame_id';

    public $timestamps = false;
    
}