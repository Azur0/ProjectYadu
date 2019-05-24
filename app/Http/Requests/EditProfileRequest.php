<?php

namespace App\Http\Requests;

use App\Gender;
use App\Rules\emailUniqueExceptSelf;
use App\Rules\genderExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditProfileRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'firstName' => ['required','min:1','max:45','string'],
            'middleName' => ['nullable', 'max:45','string'],
            'lastName' => ['nullable', 'max:45','string'],
            'gender' => [new genderExists],
            'dateOfBirth' => ['nullable', 'date', 'before:today'],
            'email' => ['required', 'string', 'email', 'max:255', new emailUniqueExceptSelf],
            'followerVisibility' => ['required', 'regex:^(private|public|follower)$^'],
            'followingVisibility' => ['required', 'regex:^(private|public|follower)$^'],
            'infoVisibility' => ['required', 'regex:^(private|public|follower)$^'],
            'eventsVisibility' => ['required', 'regex:^(private|public|follower)$^'],
            'participatingVisibility' => ['required', 'regex:^(private|public|follower)$^'],
        ];
    }
}




