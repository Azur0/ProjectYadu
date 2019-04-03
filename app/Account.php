<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    //
    protected $fillable = ['firstName', 'middleName', 'lastName', 'dateOfBirth', 'email', 'password','gender', 'avatar'];

    public function getAvatarAttribute($key)
    {
        $avatar = $this->attributes['avatar'];

//        dd($avatar);

        if ($avatar == null) {
            $filePath = public_path() . "/images/avatar.png";

            return fread(fopen($filePath, "r"), filesize($filePath));
        }
        else {
            return $avatar;
        }
    }
}
