<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSolicitudFaltaEstudiante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
             //Tabla tbl_solicitud_falta_estudiante
        Schema::create('tbl_solicitud_falta_estudiante', function(Blueprint $table){
                $table->id('id_solicitud_falta_estudiante');
                $table->integer('id_sancion_falta');
                $table->integer('id_usuario');
                $table->string('numero_registro_asignado', 7);
                $table->timestamps('fecha_falta_cometida');
                $table->integer('año');
                $table->integer('periodo');
                $table->string('observaciones', 200);
                $table->string('responsable', 200);
                $table->boolean('borrado');
                $table->boolean('apelada');
                $table->boolean('sancionada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_solicitud_falta_estudiante');
    }
}
