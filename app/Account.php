<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $fillable = ['firstName', 'middleName', 'lastName', 'dateOfBirth', 'email', 'password'];


}
