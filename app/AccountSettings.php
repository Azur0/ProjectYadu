<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSettings extends Model
{
    protected $fillable = ['account_id'];
    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id', 'id');
    }
}
