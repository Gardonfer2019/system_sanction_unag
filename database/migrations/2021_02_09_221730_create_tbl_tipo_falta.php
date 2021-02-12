<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTipoFalta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          //Tabla tbl_tipo_falta
        Schema::create('tbl_tipo_falta', function(Blueprint $table){
            $table->id('id_tipo_falta');
            $table->string('nombre_tipo', 25);
            $table->boolean('borrado');
            $table->integer('escala');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tipo_falta');
    }
}
