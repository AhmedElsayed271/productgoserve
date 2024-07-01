<?php

use App\Models\Setting;

function getPercentage($smallNum, $bigNum){
    return ($smallNum / $bigNum) * 100;
}

function getNumberFomPercentage($bigNum, $percentage){
    return ($bigNum / 100) * $percentage;
}

function getSiteName(){
    if(!session('site_name')){
        $setting = Setting::first();
        session(['site_name' => $setting->site_name]);
    }

    return session('site_name');
}

function getDateFormat(){
    if(!session('date_format')){
        $setting = Setting::first();
        session(['date_format' => $setting->date_format]);
    }

    return session('date_format');
}

function getTimeZone(){
    if(!session('time_zone')){
        $setting = Setting::first();
        session(['time_zone' => $setting->time_zone]);
    }

    return session('time_zone');
}