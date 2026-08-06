<?php

namespace App\Model\Gender;

use Illuminate\Database\Eloquent\Model;

class GenderPostsDetails extends Model
{

    protected $connection = 'gender';
   
    protected $table = 'posts_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function postsInfo()
    {
        return $this->belongsTo(GenderPost::class, 'post_id', 'post_id');
    }

    public function postsDetailsFilesInfo()
    {
        return $this->hasMany(GenderPostsDetailsFiles::class, 'detail_id', 'detail_id');
    }

    public function navDetailInfo()
    {
        return $this->hasOne(GenderNavDetails::class, 'nav_details', 'nav_details');
    }

    public function navMethodInfo()
    {
        return $this->hasOne(GenderNavMethod::class, 'nav_details', 'nav_details');
    }

}
