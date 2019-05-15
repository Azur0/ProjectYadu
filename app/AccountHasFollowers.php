<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class AccountHasFollowers extends Model
{
    protected $fillable = ['account_id', 'follower_id'];

    public function user()
    {
        return $this->belongsTo(Account::class);
    }

    public function follower()
    {
        return $this->belongsTo(Account::class);
    }
}