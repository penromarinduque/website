<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPanelDetailsPosts extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'panel_details_posts';

    protected $primaryKey = 'post_id';

    public $timestamps = false;

    public function panelInfo()
    {
    	return $this->panelDetailsInfo()->first()->panelInfo();
    }

    public function panelDetailsInfo()
    {
    	return $this->belongsTo(GenderPanelDetails::class,'post_id','detail_content_id')->where('detail_type_id','4');
    }

}