<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etud_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('idEtud');
            $table->unsignedBigInteger('idClass');
            $table->primary(['idEtud', 'idClass']);
            $table->foreign('idEtud')->references('id')->on('etuds')->onDelete('cascade');
            $table->foreign('idClass')->references('idClasse')->on('classes')->onDelete('cascade');
            $table->timestamps();
        });
        
    }
    
      

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etud_classes');
    }
}
