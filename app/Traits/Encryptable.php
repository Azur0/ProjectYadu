<?php
namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        $decrypt = ['firstName', 'middleName', 'lastName'];

        if (in_array($key, $decrypt)) {
            if (!is_null($value)) {
                $value = Crypt::decrypt($value);
            }
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        $encrypt = ['firstName', 'middleName', 'lastName'];

        if (in_array($key, $encrypt)) {
            if (!is_null($value)){
                $value = Crypt::encrypt($value);
            }
        }
        return parent::setAttribute($key, $value);
    }
}