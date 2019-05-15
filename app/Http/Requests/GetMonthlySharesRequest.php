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

        if(Carbon::parse($this->fromDate) > Carbon::parse($this->toDate)){
            $this->merge(['fromDate' => null, 'toDate' => null]);
        }

        if($this->fromDate == null){
            $this->merge(['fromDate' => $currentMonth]);
        }else{
            $this->merge(['fromDate' => Carbon::parse($this->fromDate)]);
        }

        if($this->toDate == null){
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
