<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function recommendations()
    {
        return $this->belongsToMany('App\Model\Recommendation','category_recommendations')->orderBy('created_at','DESC')->paginate(5);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
