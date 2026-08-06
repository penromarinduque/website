<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class GenderPosts extends Model
{
    protected $connection = 'website';
   
    protected $table = 'posts';

    public $primaryKey = 'post_id';

    public $timestamps = false;

    public function postDetailsInfo()
    {
        return $this->hasMany(GenderPostsDetails::class, 'post_id', 'post_id');
    }

    public function postDetailsFileInfo()
    {
        return $this->hasMany(GenderPostsDetailsFiles::class, 'post_id', 'post_id');
    }
}
