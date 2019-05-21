<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditLinkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:10'],
            'link' => ['url', 'max:60'],
            'email' => ['email', 'max:60']
        ];
    }
}
