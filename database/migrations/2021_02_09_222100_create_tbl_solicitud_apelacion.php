<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSolicitudApelacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla tbl_solicitud_apelacion
        Schema::create('tbl_solicitud_apelacion', function(Blueprint $table){
            $table->id('id_apelacion');
            $table->integer('id_solicitud_falta_estudiante');
            $table->string('numero_registro_asignado', 7);
            $table->timestamps('fecha_apelacion');
            $table->string('justificacion', 500);
            $table->boolean('resolucion');
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
        Schema::dropIfExists('tbl_solicitud_apelacion');
    }
}
