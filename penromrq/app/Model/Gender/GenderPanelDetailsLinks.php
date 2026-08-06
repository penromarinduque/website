<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPanelDetailsLinks extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'panel_details_links';

    protected $primaryKey = 'link_id';

    public $timestamps = false;

    public function panelInfo()
    {
    	return $this->panelDetailsInfo()->first()->panelInfo();
    }

    public function panelDetailsInfo()
    {
    	return $this->belongsTo(GenderPanelDetails::class,'link_id','detail_content_id')->where('detail_type_id','3');
    }

}