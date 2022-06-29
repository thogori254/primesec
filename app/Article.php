<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    // public function categories()
    // {
    //     return $this->hasManyThrough(Category::class, ArticleCategory::class, 'article_id', 'category_id');
    // }
    // public function categories2()
    // {
    //     return $this->belongsToMany(Category::class, ArticleCategory::class, 'category_id', 'article_id')
    //           ->withPivot([ 'id']);
    // }
        /**
     * Get all of the categories for the post.
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
     * Obtain public claps for the post
     */
    public function claps()
    {
        return 0;
    }


    /**
     * Increment view for every visit
     */
    public function incrementViews()
    {
        DB::table('articles')->increment('views', 1);
    }
}
