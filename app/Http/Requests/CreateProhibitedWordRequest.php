<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProhibitedWordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'newProhibitedWord' => [
                'required',
                'unique:prohibited_words,word',
                'min:1',
                'max:45',
                'string',
                'regex:^[a-z0-9]+$^']
        ];
    }
}
