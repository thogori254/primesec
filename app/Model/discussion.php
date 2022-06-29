<?php

namespace App\Model;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class discussion extends Model
{
    public function topics()
    {
        return $this->belongsToMany('App\Model\topic','topic_discussions')->withTimestamps();
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
        return route('discussion',$value);
    }

}
