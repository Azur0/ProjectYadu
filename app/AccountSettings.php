<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSettings extends Model
{
    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id', 'id');
    }
}
