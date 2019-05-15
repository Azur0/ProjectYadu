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
        if(Carbon::parse($this->fromDate) > Carbon::parse($this->toDate)){
            $this->merge(['fromDate' => null, 'toDate' => null]);
        }

        if($this->fromDate == null){
            $this->merge(['fromDate' => Carbon::now()->subYear()]);
        }else{
            $this->merge(['fromDate' => Carbon::parse($this->fromDate)]);
        }

        if($this->toDate == null){
            $this->merge(['toDate' => Carbon::now()]);
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
