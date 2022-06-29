<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    //  /**
    //  * Get all of the posts that are assigned this tag.
    //  */
    // public function articles()
    // {
    //     return $this->morphedByMany(Article::class, 'article_category');
    // }

    // /**
    //  * Get all of the videos that are assigned this tag.
    //  */
    // public function blogposts()
    // {
    //     return $this->morphedByMany(Blogpost::class, 'article_category');
    // }
}
