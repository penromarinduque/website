<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemVerification extends Model
{

    protected $table = 'system_verification';

    protected $primaryKey = 'notif_id';

    public $timestamps = false;
    
}