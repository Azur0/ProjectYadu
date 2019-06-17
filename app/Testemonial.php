<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testemonial extends Model
{
    protected $fillable = ['account_id', 'name', 'experience', 'accepted'];

    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id', 'id');
    }
}
