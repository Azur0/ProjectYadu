<?php

namespace App\Http\Requests;

use App\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: display password incorrect message instead of 401
        $account = Account::Where('id', Auth::id())->firstOrFail();
        $passwordCorrect = Hash::check($this->currentPassword, $account->password);
        $isAuthorized = isAuthorized($this->accountId);

        return ($passwordCorrect && $isAuthorized);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'string', 'min:8','confirmed']
        ];
    }
}
