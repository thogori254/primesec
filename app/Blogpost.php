<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blogpost extends Model
{
    protected $table = 'blog_posts';

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Get all of the categories for the post.
     */
    public function categories()
    {
        //$this->morphToMany(Category::class, 'article_category');
        //SELECT categories.name FROM mBlog.categories inner join article_categories on categories.id = article_categories.category_id inner join articles on article_categories.article_category_id = articles.id where ;
        return $categories = Category::join('article_categories',  'categories.id', '=', 'article_categories.category_id')->join('blog_posts', 'article_categories.article_category_id', '=', 'blog_posts.id')->where('type', 'blogpost')->where('articles.id', '=', $this->id)->select('name');
    }

    public function master_category()
    {
        $this->belongsTo(MasterCategory::class);
    }

    public function headerUrl()
    {
        if(empty($this->header)){
            return null;// "https://mblogstatics.s3.amazonaws.com/static_images/default.jpg";
        }
        return 'https://mblogstatics.s3.us-east-1.amazonaws.com/'.$this->header;
    }

    public function claps()
    {
        return 0;
    }

    public static function incrementViews()
    {
        DB::table('blog_posts')->increment('views', 1);
    }
}
