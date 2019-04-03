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

    protected $fillable = ['firstName', 'middleName', 'lastName', 'dateOfBirth', 'email', 'password','gender'];

    /*
    protected $dispatchesEvents = [
        'created' => AccountCreatedEvent::class
    ];*/

    public function gender(){
       return $this->belongsTo(Gender::class);
    }
}
