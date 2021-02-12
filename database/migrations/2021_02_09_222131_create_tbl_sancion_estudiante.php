<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSancionEstudiante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                 //Tabla tbl_sancion_estudiante
        Schema::create('tbl_sancion_estudiante', function(Blueprint $table){
                $table->id('id_sancion_estudiante');
                $table->integer('id_solicitud_falta_estudiante');
                $table->integer('id_apelacion');
                $table->string('numero_registro_asignado', 7)->change();
                $table->integer('id_usuario');
                $table->boolean('borrado');
                $table->string('dictamen', 500)->change();
                $table->boolean('sancionado');
                $table->timestamps('fecha_sancion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sancion_estudiante');
    }
}
