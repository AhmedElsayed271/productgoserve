<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class settingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Setting::firstOrCreate([
            'logo'          => 'logo.jpg',
            'site_name'          => 'Name',
            'date_format'   => 'Y-m-d',
            'time_zone'     => 'Africa/Cairo',
        ]);
    }
}
