<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('global.roles') as $key => $values){
            foreach($values as $value){
                $sub_role = Permission::firstOrCreate([
                    'name'          => $value . '-' . $key,
                    'display_name'  => $value . ' ' . $key,
                    'description'   => $value . ' ' . $key,
                ]);
            }
        }
    }
}
