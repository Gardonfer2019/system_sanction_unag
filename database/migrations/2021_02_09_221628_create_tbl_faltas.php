<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFaltas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Tabla tbl_faltas
        Schema::create('tbl_faltas', function(Blueprint $table){
            $table->id('id_falta');
            $table->integer('id_tipo_falta');
            $table->integer('incurrencia');
            $table->integer('orden');
            $table->string('descripcion', 500);
            $table->boolean('borrado');
            $table->integer('reglamento');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_faltas');
    }
}
