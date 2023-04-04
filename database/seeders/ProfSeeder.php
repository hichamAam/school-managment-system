<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('profs')->insert([
            'userID' => 3,
            'nom' => 'simon',
            'prenom' => 'simon',
            'tel' => '0123456789',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
