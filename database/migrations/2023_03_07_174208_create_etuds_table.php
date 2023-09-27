<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudsTable extends Migration
{
    
    public function up()
    {
        Schema::create('etuds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->nullable()->constrained('users')->onDelete('CASCADE');
            $table->string('nom');
            $table->string('prenom');
            $table->date('bdate')->nullable();
            $table->string('niveau')->nullable();
            $table->string('tel')->nullable();
            $table->string('adresse')->nullable();
            $table->timestamps();
        });
        
    }

    
    public function down()
    {
        Schema::dropIfExists('etuds');
    }
}
