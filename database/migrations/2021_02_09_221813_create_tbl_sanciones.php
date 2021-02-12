<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSanciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           //Tabla tbl_sanciones
        Schema::create('tbl_sanciones', function(Blueprint $table){
            $table->id('id_sancion');
            $table->string('nombre_sancion', 500);
            $table->boolean('borrado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sanciones');
    }
}
