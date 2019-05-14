<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GetMonthlySharesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if($this->toMonth == null){
            $this->merge(['toDate' => Carbon::now()]);
        }else{
            $this->merge(['toDate' => Carbon::parse($this->toDate)]);
        }
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
