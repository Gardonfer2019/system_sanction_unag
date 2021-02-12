<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solouser',['only'=>'index']);
        
    }

    public function index(){
        
        $numero_registro_asignado= Auth::user()->username;

        // dd($numero_registro_asignado);
        $listarFaltasImpuestas=DB::SELECT("WITH LISTA_FALTA_SANCION AS ( SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
        LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
        LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
        LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
        ORDER BY TSF.ID_SANCION_FALTA ASC)
        
        SELECT  tsfe.id_solicitud_falta_estudiante, tsfe.numero_registro_asignado, 
        to_char( tsfe.fecha_falta_cometida, 'yyyy-MM-dd') as fecha_falta_cometida, tsfe.responsable, tsfe.observaciones, lfs.*
            FROM tbl_solicitud_falta_estudiante tsfe
                JOIN lista_falta_sancion lfs ON tsfe.id_sancion_falta=lfs.id_sancion_falta
                WHERE tsfe.numero_registro_asignado=:numero_registro_asignado and tsfe.apelada=false AND tsfe.sancionada=false",["numero_registro_asignado"=>$numero_registro_asignado]);
        
        return view('estudiante', ["contarFaltas"=>count($listarFaltasImpuestas)]);
    }
}
