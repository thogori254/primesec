<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    public $timestamps = false;

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function blogposts() {
        return $this->hasMany(Blogpost::class);
    }
}
