<?php

namespace App\Traits;

use App\Models\Setting;
use DateTime;
use DateTimeZone;

trait helper
{
    public static function date_format($date){
        $newDate = new DateTime($date, new DateTimeZone(env('TIMEZONE', 'Africa/Cairo')) ); //in defoult timezone
        $newDate->setTimeZone(new DateTimeZone(getTimeZone())); // in setting time_zone

        return $newDate->format(getDateFormat());
    }
}