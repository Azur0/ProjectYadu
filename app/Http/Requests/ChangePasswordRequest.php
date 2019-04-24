<?php

namespace App\Http\Requests;

use App\Rules\matchesDatabasePassword;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currentPassword' => ['required', new matchesDatabasePassword()],
            'newPassword' => ['required', 'string', 'min:8','confirmed']
        ];
    }
}
