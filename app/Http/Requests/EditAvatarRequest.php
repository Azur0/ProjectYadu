<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditAvatarRequest extends FormRequest
{
    public function authorize()
    {
        //TODO: Test this
        return $this->accountId == Auth::id();
    }

    public function rules()
    {
        return [
            'accountId' => ['required'],
            'avatar' => ['required', 'mimes:jpeg,jpg,png']
        ];
    }
}
