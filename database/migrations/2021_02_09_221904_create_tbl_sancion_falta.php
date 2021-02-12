<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSancionFalta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //Tabla tbl_sancion_falta
        Schema::create('tbl_sancion_falta', function(Blueprint $table){
            $table->id('id_sancion_falta');
            $table->integer('id_sancion');
            $table->integer('id_falta');
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
        Schema::dropIfExists('tbl_sancion_falta');
    }
}
