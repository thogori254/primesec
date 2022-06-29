<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Analysis extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Get master category for the post.
     */
    public function master_category()
    {
        return $this->belongsTo(MasterCategory::class);
    }

     /**
     * Prepare header url
     */
    public function headerUrl()
    {
        if(empty($this->header)){
            return null;//"https://mblogstatics.s3.amazonaws.com/static_images/default.jpg";
        }
        return 'https://mblogstatics.s3.us-east-1.amazonaws.com/'.$this->header;
    }


    /**
     * Increment view for every visit
     */
    public function incrementViews()
    {
        DB::table('analyses')->increment('views', 1);
    }


    /**
     * Obtain public claps for the post
     */
    public function claps()
    {
        return 0;
    }

}
