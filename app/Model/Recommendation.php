<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Recommendation extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Model\tag','recommendation_tags')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\category','category_recommendations')->withTimestamps();;
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }



    public function getSlugAttribute($value)
    {
        return route('recommendation',$value);
    }

}
