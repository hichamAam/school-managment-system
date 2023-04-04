<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfsTable extends Migration
{
    
    public function up()
    {
        Schema::create('profs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users')->onDelete('CASCADE');
            $table->string('nom');
            $table->string('prenom');
            $table->string('tel');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('profs');
    }
}
