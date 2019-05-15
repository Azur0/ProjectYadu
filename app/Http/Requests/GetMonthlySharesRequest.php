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
        $currentMonth = Carbon::parse(Carbon::now()->format('Y M'));

        if($this->fromDate == null){
            $this->merge(['fromDate' => $currentMonth]);
        }else{
            $this->merge(['fromDate' => Carbon::parse($this->fromDate)]);
        }

        if($this->toMonth == null){
            $this->merge(['toDate' => $currentMonth]);
        }else{
            $this->merge(['toDate' => Carbon::parse($this->toDate)]);
        }
    }

    public function rules()
    {
        return [
            'fromDate' => ['nullable', 'before:today'],
            'toDate' => ['nullable', 'before:tomorrow']
        ];
    }
}
