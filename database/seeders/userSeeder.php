<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'username'  => 'ahmed1',
            'name'  => 'ahmed elsayed',
            'super' => 1,
            'password'  => bcrypt('ahmed1'),
        ]);
    }
}
