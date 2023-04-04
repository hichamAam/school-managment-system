<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtudSeeder extends Seeder
{
    function run()
    {
        DB::table('etuds')->insert([
            'userID' => 6,
            'nom' => 'mustapha',
            'prenom' => 'messi',
            'bdate' => '1983-09-23',
            'niveau' => '2 bac',
            'tel' => '0123456789',
            'adresse' => 'agadir',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
