<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'hicham',
            'email' => 'hicham@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => bcrypt('hicham'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
 