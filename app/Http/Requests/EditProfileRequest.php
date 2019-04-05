<?php

namespace App\Http\Requests;

use App\Gender;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
        $genders = collect();
        foreach (Gender::all() as $gender){
            $genders->push($gender->gender);
        }

        return [
            'firstName' => ['required','min:1','max:45','string'],
            'middleName' => ['nullable', 'max:45','string'],
            'lastName' => ['nullable', 'max:45','string'],
            //'gender' => ['in:'.$genders],
            'gender' => [''],
            'dateOfBirth' => ['nullable', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts,email']
        ];
    }
}
