<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class BuscadorController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('solopersonal');
        
        
        
        

    }
    public function index()
    {
        $listarEstudiantes=DB::SELECT("SELECT RFE.numero_registro_asignado,
        concat(RFE.primer_apellido_estudiante, ' ', 
                          RFE.segundo_apellido_estudiante, ' ', 
                          RFE.primer_nombre_estudiante, ' ', 
                          RFE.segundo_nombre_estudiante) AS NOMBRE_COMPLETO
        FROM reg_ficha_estudiante RFE
        WHERE RFE.borrado=false");


        return VIEW('buscador.buscador', ['listarEstudiantes'=>$listarEstudiantes]);
    }

      //inica showBuscador
    public function buscarEstudiante(Request $request)
    {
          //$nombre_completo=$request->nombre_completo;
          //$numero_registro_asignado=$request->numero_registro_asignado
          if($request){
            $numero_registro_asignado = $request->numero_registro_asignado;
            $buscarEstudiante=DB::select("WITH ESTUDIANTES AS 
                  (SELECT concat(RFE.primer_apellido_estudiante, ' ', 
                      RFE.segundo_apellido_estudiante, ' ', 
                      RFE.primer_nombre_estudiante, ' ', 
                      RFE.segundo_nombre_estudiante) AS NOMBRE_COMPLETO, 
                      RFCA.NUMERO_REGISTRO_ASIGNADO,
                      RFCA.ID_USUARIO,
                      RFCA.ID_CARRERA,
                      RFCA.UBICACION,
                      AC.NOMBRE_CARRERA FROM REG_FICHA_ESTUDIANTE RFE
                  JOIN REG_FICHA_CARRERA_ADMITIDO RFCA ON RFE.NUMERO_REGISTRO_ASIGNADO=RFCA.NUMERO_REGISTRO_ASIGNADO
                  JOIN ACA_CARRERA AC ON RFCA.ID_CARRERA=AC.ID_CARRERA)
  
              SELECT NUMERO_REGISTRO_ASIGNADO as numero_registro_asignado,
                    NOMBRE_COMPLETO as nombre_completo,
                    ID_USUARIO as id_usuario,
                    ID_CARRERA as id_carrera,
                    NOMBRE_CARRERA  as nombre_carrera,
                    CASE 
                        WHEN ubicacion = 'I' THEN 'Interno'
                        WHEN ubicacion = 'E' THEN 'Externo'
                        END ubicacion
                  FROM ESTUDIANTES
                  WHERE NUMERO_REGISTRO_ASIGNADO=:numero_registro_asignado", ["numero_registro_asignado"=>$numero_registro_asignado]);      
            }
          //dd(array('estudiante'=>$buscarEstudiante));
        //dd(response()->json($buscarEstudiante, 200));
            //dd($buscarEstudiante);
             //dd=dd($numero_registro_asignado);
            // dd(array($buscarEstudiante[0]->numero_registro_asignado,
            //     $buscarEstudiante[0]->nombre_completo,
            //     $buscarEstudiante[0]->nombre_carrera)
            // );

            // $tipo= Auth::user()->tipo;
            // if($tipo==5){
            //   $listarFaltas= DB::SELECT("SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
            //   LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
            //   LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
            //   LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
            //   ORDER BY TSF.ID_SANCION_FALTA ASC"); 
            // }else{
            //   $listarFaltas= DB::SELECT("SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
            //   LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
            //   LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
            //   LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
            //   WHERE TTF.ESCALA=:TIPO
              
            //   ORDER BY TSF.ID_SANCION_FALTA ASC", ["TIPO"=>$tipo]); 
            // }
          
          $listarFaltas= DB::SELECT("SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION 
                    FROM TBL_SANCION_FALTA TSF
                    LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                    LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                    LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
                    WHERE TF.REGLAMENTO=2
                    ORDER BY TSF.ID_SANCION_FALTA ASC"); 
         

            
          
           

          if(count($buscarEstudiante)==0){
              session()->flash('error', 'El estudiante no existe');
              return redirect()->route('buscar.vista');
          }else{
            return VIEW('buscador.detalle',['numero_registro_asignado'=>($buscarEstudiante[0]->numero_registro_asignado),
                          'nombre_completo'=>($buscarEstudiante[0]->nombre_completo),
                          'nombre_carrera'=>($buscarEstudiante[0]->nombre_carrera),
                          'ubicacion'=>($buscarEstudiante[0]->ubicacion),
                          'listarFaltas'=>$listarFaltas]);
          }


            
    }//fin showBuscador

    public function listarFaltas(){

      $listarFaltas= DB::SELECT('SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
      LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
      LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
      LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
      WHERE TTF.NOMBRE_TIPO="LEVES"
      
      ORDER BY TSF.ID_SANCION_FALTA ASC');

      // dd($listarFaltas);

      return VIEW('tablas.tablaFaltas', ["listarFaltas"=>$listarFaltas]);
      //return response()->json($listarFaltas,200);
    }

   
}
