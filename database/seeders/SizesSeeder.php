<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = Size::insert([
            [
                'name'          => '48',
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => '50',
                'created_at'    => Carbon::now()
                
            ],
            [
                'name'          => '52',
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => '54',
                'created_at'    => Carbon::now()
            ],
        ]);
    }
}
