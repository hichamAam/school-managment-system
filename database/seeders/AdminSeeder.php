<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    function run()
    {
        DB::table('admins')->insert([
            'userID' => 1,
            'nom' => 'hicham',
            'prenom' => 'hicham',
            'tel' => '0123456789',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
 