<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditAvatarRequest extends FormRequest
{
    public function authorize()
    {
        return $this->accountId == Auth::id();
    }

    public function rules()
    {
        return [
            'accountId' => ['required'],
            'avatar' => ['required', 'mimes:jpeg,jpg,png', 'dimensions:max_width=400, max_height=400, ratio=1', 'max:10240']
        ];
    }
}
