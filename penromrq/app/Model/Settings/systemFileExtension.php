<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemFileExtension extends Model
{

    protected $table = 'system_file_extension';

    protected $primaryKey = 'extension_id';

    public $timestamps = false;
    
}
