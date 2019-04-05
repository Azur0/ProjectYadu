<?php

namespace App\Http\Requests;

use App\Rules\matchesDatabasePassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAuthorized($this->accountId);
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
