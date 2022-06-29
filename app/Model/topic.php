<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    public function discussions()
    {
        return $this->belongsToMany('App\Model\discussion','topic_discussions')->orderBy('created_at','DESC')->paginate(5);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }}
