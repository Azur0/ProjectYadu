<?php

namespace App\Http\Requests;

use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GetTotalEventsCreatedRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if($this->toDate == null){
            $this->merge(['toDate' => Carbon::now()]);
        }else{
            $this->merge(['toDate' => Carbon::parse($this->toDate)]);
        }

        if($this->fromDate == null){
            $this->merge(['fromDate' => Carbon::today()->subYear()]);
        }else{
            $this->merge(['fromDate' => Carbon::parse($this->fromDate)]);
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
