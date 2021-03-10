<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ApelacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solouser');
        
        

    }
    public function index()
    {
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
        
        if(count($listarFaltasImpuestas)==0){
            Session()->flash('error','No se encontraron faltas');
            return redirect()->route('estudiante');
        }else{
        //    dd($listarFaltasImpuestas);
            return view('apelacion.apelacion', ["listarFaltasImpuestas"=>$listarFaltasImpuestas]);
        }        

        
    }
    public function create(Request $request)
    {
        $id_falta= $request->id_falta;
        
        $falta=DB::SELECT("WITH LISTA_FALTA_SANCION AS ( SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
        LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
        LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
        LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
        ORDER BY TSF.ID_SANCION_FALTA ASC)
        
        SELECT  tsfe.id_solicitud_falta_estudiante, tsfe.numero_registro_asignado, 
                to_char( tsfe.fecha_falta_cometida, 'yyyy-MM-dd') as fecha_falta_cometida, tsfe.responsable, tsfe.observaciones, lfs.*
            FROM tbl_solicitud_falta_estudiante tsfe
                JOIN lista_falta_sancion lfs ON tsfe.id_sancion_falta=lfs.id_sancion_falta
                WHERE tsfe.id_solicitud_falta_estudiante=:id_falta and tsfe.apelada=false and tsfe.borrado=false and tsfe.sancionada=false tsfe.reincidencia=false",["id_falta"=>$id_falta]);

        //  dd($falta);        
       return view('apelacion.formApelacion',["descripcion"=>$falta[0]->descripcion,
                                            "numero_registro_asignado"=>$falta[0]->numero_registro_asignado,
                                            "id_falta"=>$falta[0]->id_solicitud_falta_estudiante,
                                            "descripcion"=>$falta[0]->descripcion,
                                            "observaciones"=>$falta[0]->observaciones]);
    }
    
    public function store(Request $request){

        // Validación
        request()->validate([
            "inputFechaApelacion"=>'required',
            "inputJustificacion"=>'required'
        ]);

        //Capturar Datos
        $id_falta=$request->inputIdFalta;
        $numero_registro_asignado=$request->inputNumeroRegistroAsignado;
        $fechaApelacion=$request->inputFechaApelacion;
        $justificacion=$request->inputJustificacion;
        $borrado=$request->inputBorrado;
        $resolucion=$request->inputResolucion;
        $apelacion=$request->inputApelada;
        
        $insert = DB::INSERT("INSERT INTO tbl_solicitud_apelacion(
            id_solicitud_falta_estudiante, numero_registro_asignado, fecha_apelacion, justificacion, resolucion, borrado)
           VALUES (:id_falta, :numero_registro_asignado, :fecha_apelacion, :justificacion, :resolucion, :borrado);",
           ["id_falta"=>$id_falta,
           "numero_registro_asignado"=>$numero_registro_asignado,
           "fecha_apelacion"=>$fechaApelacion,
           "justificacion"=>$justificacion,
           "resolucion"=>$resolucion,
           "borrado"=>$borrado]);

        $put= DB::UPDATE("UPDATE tbl_solicitud_falta_estudiante
        SET  apelada=:apelada
        WHERE id_solicitud_falta_estudiante=:id_falta",[
            "apelada"=>$apelacion,
            "id_falta"=>$id_falta
        ]);   
        
        Session()->flash('apelacion','La apelación ha sido enviada correctamente');

        return redirect()->route('estudiante');
    }
}
