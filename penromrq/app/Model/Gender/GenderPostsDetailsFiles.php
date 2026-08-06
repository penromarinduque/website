<?php

namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

class GenderPostsDetailsFiles extends Model
{
    protected $connection = 'gender';
   
    protected $table = 'posts_details_files';

    protected $primaryKey = 'file_id';

    public $timestamps = false;

    public function postsInfo()
    {
        return $this->belongsTo(GenderPost::class, 'post_id', 'post_id');
    }
}
