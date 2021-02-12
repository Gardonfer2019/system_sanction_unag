<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HistorialFaltasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solodde');
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

        return view('historial-faltas-estudiante.buscarHistorial', ['listarEstudiantes'=>$listarEstudiantes]);
    }

    public function show(Request $request)
    {
        if($request)
        {
            $numero_registro_asignado=$request->numero_registro_asignado;
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

            $listaFaltasSancionadas=DB::select("WITH LISTA_FALTA_SANCION AS 
                    (SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, 
                        TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION 
                    FROM TBL_SANCION_FALTA TSF
                    LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                    LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                    LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
                    ORDER BY TSF.ID_SANCION_FALTA ASC)

                SELECT  tse.id_solicitud_falta_estudiante, tse.numero_registro_asignado, 
                            tse.dictamen, tse.sancionado,
                            tsfe.responsable,
                            to_char( tsfe.fecha_falta_cometida, 'yyyy-MM-dd') as fecha_falta_cometida, to_char( tse.fecha_sancion, 'yyyy-MM-dd') as fecha_sancion,
                            lfs.DESCRIPCION, lfs.NOMBRE_TIPO, lfs.NOMBRE_SANCION
                    FROM tbl_sancion_estudiante tse
                    JOIN tbl_solicitud_falta_estudiante tsfe ON tse.id_solicitud_falta_estudiante=tsfe.id_solicitud_falta_estudiante
                    JOIN lista_falta_sancion lfs ON tsfe.id_sancion_falta=lfs.id_sancion_falta
                    WHERE tse.numero_registro_asignado=:numero_registro_asignado AND tse.sancionado=true
                    ORDER BY fecha_falta_cometida asc",["numero_registro_asignado"=>$numero_registro_asignado]);
            
            $ubicacion=DB::SELECT("SELECT rfea.numero_registro_asignado, rfea.edificio, rfea.aula, ie.descripcion
                            FROM reg_ficha_estudiante_anexo rfea
                            JOIN inf_edificio ie ON rfea.edificio=ie.id_edificio
                            WHERE rfea.numero_registro_asignado=:numero_registro_asignado",["numero_registro_asignado"=>$numero_registro_asignado]);

            $listarEdificio=DB::SELECT("SELECT  id_edificio, descripcion, numero_unidades, borrado
                            FROM inf_edificio");
            
            
        }   
           
        if(count($buscarEstudiante)==0)
        {
            session()->flash('error', 'El estudiante no existe');
            return redirect()->route('historial-faltas.index');
        }else
        {
            return view('historial-faltas-estudiante.historialFaltas', ['numero_registro_asignado'=>($buscarEstudiante[0]->numero_registro_asignado),
                                                                    'nombre_completo'=>($buscarEstudiante[0]->nombre_completo),
                                                                    'nombre_carrera'=>($buscarEstudiante[0]->nombre_carrera),
                                                                    'ubicacion'=>($buscarEstudiante[0]->ubicacion),
                                                                    'listaFaltasSancionadas'=>$listaFaltasSancionadas,
                                                                    'edicio'=>$ubicacion[0]->edificio,
                                                                    'aula'=>$ubicacion[0]->aula,
                                                                    'descripcion_edificio'=>$ubicacion[0]->descripcion,
                                                                    'listarEdificio'=>$listarEdificio
                                                                    ]);
        }
        

        
    }

    public function datosGrafico(Request $request)
    {
        $numero_registro_asignado=$request->numero_registro_asignado;
        $data=DB::select("WITH 
            LISTA_FALTA_SANCION AS 
                (SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
                    LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                    LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                    LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA
                    ORDER BY TSF.ID_SANCION_FALTA ASC),
                           
            historial_faltas AS
            	(SELECT  tse.id_solicitud_falta_estudiante, tse.numero_registro_asignado, 
                    tse.dictamen, tse.sancionado,
                    tsfe.responsable,
                    to_char( tsfe.fecha_falta_cometida, 'yyyy-MM-dd') as fecha_falta_cometida, to_char( tse.fecha_sancion, 'yyyy-MM-dd') as fecha_sancion,
                    lfs.DESCRIPCION, lfs.NOMBRE_TIPO, lfs.NOMBRE_SANCION
                    FROM tbl_sancion_estudiante tse
                    JOIN tbl_solicitud_falta_estudiante tsfe ON tse.id_solicitud_falta_estudiante=tsfe.id_solicitud_falta_estudiante
                    JOIN lista_falta_sancion lfs ON tsfe.id_sancion_falta=lfs.id_sancion_falta
                    WHERE tse.sancionado=true
                    ORDER BY tse.id_sancion_estudiante)
        
                SELECT numero_registro_asignado, nombre_tipo, count(numero_registro_asignado) as Faltas
                    FROM historial_faltas
                    WHERE numero_registro_asignado=:numero_registro_asignado
                    GROUP BY numero_registro_asignado, nombre_tipo",["numero_registro_asignado"=>$numero_registro_asignado]);
                    
        return response()->json($data,200);
    }

    public function edit(Request $request)
    {
        //Captura de datos
        $numero_registro_asignado=$request->inputNumeroRegistro;
        $ubicacion=$request->selectUbicacion;
        $edificio=$request->selectEdificio;
        $habitacion=$request->inputHabitacion;

        $updateUbicacion=DB::UPDATE("UPDATE reg_ficha_carrera_admitido
                    SET ubicacion=:ubicacion
                    WHERE numero_registro_asignado=:numero_registro_asignado",['ubicacion'=>$ubicacion, 'numero_registro_asignado'=>$numero_registro_asignado]);
        
        if($edificio=='' && $habitacion==''){
            //Cambiar el Id del edificio
            $updateEdificio=DB::UPDATE("UPDATE reg_ficha_estudiante_anexo
                        SET  edificio=8, aula=0
                        WHERE numero_registro_asignado=:numero_registro_asignado", ['numero_registro_asignado'=>$numero_registro_asignado]);
        }else {
            $updateEdificio=DB::UPDATE("UPDATE reg_ficha_estudiante_anexo
                        SET  edificio=:edificio, aula=:habitacion
                        WHERE numero_registro_asignado=:numero_registro_asignado", ['edificio'=>$edificio, 'habitacion'=>$habitacion, 'numero_registro_asignado'=>$numero_registro_asignado]);
        }
        
        

        session()->flash('actualizado', 'La información ha sido actualizada satisfactoriamente');
        return redirect(url("/historial-faltas/buscar/$numero_registro_asignado"));
    }
}
