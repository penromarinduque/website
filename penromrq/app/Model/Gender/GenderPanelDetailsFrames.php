<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPanelDetailsFrames extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'panel_details_frames';

    protected $primaryKey = 'frame_id';

    public $timestamps = false;

    public function panelInfo()
    {
    	return $this->panelDetailsInfo()->first()->panelInfo();
    }

    public function panelDetailsInfo()
    {
    	return $this->belongsTo(GenderPanelDetails::class,'frame_id','detail_content_id')->where('detail_type_id','2');
    }

}