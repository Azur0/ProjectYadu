<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountHasFollowers extends Model
{
    protected $fillable = ['account_id', 'follower_id'];
}
