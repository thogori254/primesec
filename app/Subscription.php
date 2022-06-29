<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //

    protected $fillable = [
        'amount','phone_number','package_type','user_id','transaction_reference', 'subscription_status', 'time_of_payment', 'expiration'
    ];
}
