<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(){
        $setting = Setting::first();

        return view('Dashboard.settings.edit')->with('data', $setting);
    }

    public function update(Request $request){
        $setting = Setting::first();

        $setting->site_name = $request->site_name;
        $setting->date_format = $request->date_format;
        $setting->time_zone = $request->time_zone;
        $setting->save();

        //update sessaions
        session(['site_name'    => $setting->site_name]);
        session(['date_format'  => $setting->date_format]);
        session(['time_zone'    => $setting->time_zone]);

        return redirect(route('dashboard.settings.edit'))->with('success', 'success');
    }
}
