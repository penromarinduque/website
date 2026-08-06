<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPanelDetailsFiles extends Model
{

    protected $connection = 'gender';
  
    protected $table = 'panel_details_files';

    protected $primaryKey = 'file_id';

    public $timestamps = false;

    public function panelInfo()
    {
    	return $this->panelDetailsInfo()->first()->panelInfo();
    }

    public function panelDetailsInfo()
    {
    	return $this->belongsTo(GenderPanelDetails::class,'file_id','detail_content_id')->where('detail_type_id','1');
    }

}