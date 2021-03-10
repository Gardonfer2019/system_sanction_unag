<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FaltasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solopersonal');
        

    }
    public function creat()
    {
        return view('faltas.solicitudFalta');
    }//creat: Muestra el Formulario de Solicitud de Falta

    public function datosEstudiante(Request $request)
    {
        if($request){
          $numero_registro_asignado = trim($request->get('search'));
          $buscarEstudiante=DB::select("WITH ESTUDIANTES AS 
                (SELECT concat(RFE.primer_apellido_estudiante, ' ', 
                    RFE.segundo_apellido_estudiante, ' ', 
                    RFE.primer_nombre_estudiante, ' ', 
                    RFE.segundo_nombre_estudiante) AS NOMBRE_COMPLETO, 
                    RFCA.NUMERO_REGISTRO_ASIGNADO,
                    RFCA.ID_USUARIO,
                    RFCA.ID_CARRERA,
                    AC.NOMBRE_CARRERA FROM REG_FICHA_ESTUDIANTE RFE
                JOIN REG_FICHA_CARRERA_ADMITIDO RFCA ON RFE.NUMERO_REGISTRO_ASIGNADO=RFCA.NUMERO_REGISTRO_ASIGNADO
                JOIN ACA_CARRERA AC ON RFCA.ID_CARRERA=AC.ID_CARRERA)

            SELECT NUMERO_REGISTRO_ASIGNADO as numero_registro_asignado,
                  NOMBRE_COMPLETO as nombre_completo,
                  ID_USUARIO as id_usuario,
                  ID_CARRERA as id_carrera,
                  NOMBRE_CARRERA  as nombre_carrera FROM ESTUDIANTES
                WHERE NUMERO_REGISTRO_ASIGNADO=:numero_registro_asignado", ["numero_registro_asignado"=>$numero_registro_asignado]);  
                
                
                
          }

         // dd($buscarEstudiante);
          return response()->json($buscarEstudiante,200);
    }//muestra los datos de los estudiantes en formato json,  prueba

    public function store(Request $request){
       
       //$n=count($request->get('checkBoxFalta'));

        //Validación
        request()->validate([
            'inputNumeroRegistroAsignado'=>'required',
            'inputFechaFalta'=>'required',
            'inputAnioFalta'=>'required',
            'inputPeriodo'=>'required',
            'inputObservaciones'=>'required',
            'inputResponsable'=>'required'
        ]);



       $checkBoxFalta=array();
       if(isset($request->checkBoxFalta)){
            $checkBoxFalta=$request->checkBoxFalta;
       } 
        $temp="";
        foreach($checkBoxFalta as $c){
            $temp= $c;
            $id_usuario= $request->inputUsuario;
            $numero_registro_asignado= $request->inputNumeroRegistroAsignado;
            $fechaFalta= $request->inputFechaFalta;
            $anio=$request->inputAnioFalta;
            $periodo= $request->inputPeriodo;
            $observaciones=$request->inputObservaciones;
            $responsable=$request->inputResponsable;
            $borrado=$request->inputBorrado;
            $apelada=$request->inputApelada;
            $sancionada=$request->inputSancionada;
            $reincidencia=$request->inputReincidencia;

            $insert= DB::insert("INSERT INTO tbl_solicitud_falta_estudiante(
                id_sancion_falta, id_usuario, numero_registro_asignado, fecha_falta_cometida, año, periodo, observaciones, responsable, borrado, apelada, sancionada, reincidencia)
               VALUES ( :temp, :id_usuario, :numero_registro_asignado, :fechaFalta, :anio, :periodo, :observaciones, :responsable, :borrado, :apelada, :sancionada, :reincidencia);",
               ["temp"=>$temp,
               "id_usuario"=>$id_usuario,
               "numero_registro_asignado"=>$numero_registro_asignado,
               "fechaFalta"=>$fechaFalta,
               "anio"=>$anio,
               "periodo"=>$periodo,
               "observaciones"=>$observaciones,
               "responsable"=>$responsable,
               "borrado"=>$borrado,
               "apelada"=>$apelada,
               "sancionada"=>$sancionada,
               "reincidencia"=>$reincidencia]);

            
        }
        
        session()->flash('Exito', 'La falta fue impuesta correctamente');

        return redirect()->route('buscar.index');
        
        

    }
}
