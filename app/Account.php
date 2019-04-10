<?php

namespace App;

use App\Events\AccountCreatedEvent;
use App\Mail\Confirmation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class Account extends Authenticatable implements MustVerifyEmailContract
{
    //
    use Notifiable;

    protected $fillable = ['firstName', 'middleName', 'lastName', 'dateOfBirth', 'email', 'password','gender', 'avatar'];

    public function getAvatarAttribute($key)
    {
        $avatar = $this->attributes['avatar'];

        if ($avatar == null) {
            $filePath = public_path() . "/images/avatar.png";

            return fread(fopen($filePath, "r"), filesize($filePath));
        }
        else {
            return $avatar;
        }
    }

    public function gender(){
       return $this->belongsTo(Gender::class);
    }
}
