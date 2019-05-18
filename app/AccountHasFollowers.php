<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class AccountHasFollowers extends Model
{
    protected $fillable = ['account_id', 'follower_id'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'id','account_id');
    }

    public function follower()
    {
        return $this->belongsTo(Account::class,'id','follower_id');
    }
}