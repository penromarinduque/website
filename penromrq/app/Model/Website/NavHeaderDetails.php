<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class NavHeaderDetails extends Model
{
  
    protected $table = 'web_nav_header_details';

    protected $primaryKey = 'nav_id';

    public $timestamps = false;

    public function nav_sub()
    {
        $query = $this->hasMany(NavHeaderDetails::class,'nav_parent','nav_id');

        $query = $query->where('status','1')->orderBy('order_level','asc')->with('nav_sub')->with('nav_method');

        return $query;
    }

    public function nav_method()
    {
        return $this->hasOne(NavHeaderMethod::class,'nav_id','nav_id');
    }

    public function nav_parent()
    {
        return $this->belongsTo(NavHeaderDetails::class,'nav_parent','nav_id');
    }
    
}
