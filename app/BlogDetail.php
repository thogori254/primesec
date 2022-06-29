<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogDetail extends Model
{
    public static function incrementVisit()
    {
        DB::table('blog_details')->increment('total_visits', 1);
    }
}
