<?php
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

trait DateToText
{
    public function dateToText($timestamp)
    {
        setlocale(LC_ALL, App::getLocale());
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);
        $formatted_date = ucfirst($date->formatLocalized(__('formats.writtenDateFormat_short')));
        return $formatted_date;
    }
}