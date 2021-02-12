<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EstadisticasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solodde',['only'=>'index']);
    }

    public function index()
    {
        return view('estadisticas.filtrarDetalle');
    }
    public function show(Request $request)
    {
        //Capturar datos
        $fechaInicio=$request->inputFechaInicio;
        $fechaFinal=$request->inputFechaFinal;

        $listarSancionados=DB::SELECT("WITH ESTUDIANTES AS 
                    (SELECT concat(RFE.primer_apellido_estudiante, ' ', 
                        RFE.segundo_apellido_estudiante, ' ', 
                        RFE.primer_nombre_estudiante, ' ', 
                        RFE.segundo_nombre_estudiante) AS NOMBRE_COMPLETO, 
                        RFCA.NUMERO_REGISTRO_ASIGNADO,
                        RFCA.ID_USUARIO,
                        RFCA.ID_CARRERA,
                        AC.NOMBRE_CARRERA FROM REG_FICHA_ESTUDIANTE RFE
                    JOIN REG_FICHA_CARRERA_ADMITIDO RFCA ON RFE.NUMERO_REGISTRO_ASIGNADO=RFCA.NUMERO_REGISTRO_ASIGNADO
                    JOIN ACA_CARRERA AC ON RFCA.ID_CARRERA=AC.ID_CARRERA),
            listado_faltas as 
                    (SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
                LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA)
                    
            SELECT tse.id_sancion_estudiante, to_char( tse.fecha_sancion, 'yyyy-MM-dd') as fecha_sancion, tse.numero_registro_asignado, e.nombre_completo
            FROM tbl_sancion_estudiante tse
            JOIN estudiantes e ON tse.numero_registro_asignado=e.numero_registro_asignado
            WHERE tse.sancionado=true AND tse.borrado=false AND tse.fecha_sancion BETWEEN :fechaInicio AND :fechaFinal
            ORDER BY tse.fecha_sancion asc",['fechaInicio'=>$fechaInicio, 'fechaFinal'=>$fechaFinal]);
        $countSanciones=count($listarSancionados);

        $listarEnEspera=DB::SELECT("WITH ESTUDIANTES AS 
                        (SELECT concat(RFE.primer_apellido_estudiante, ' ', 
                            RFE.segundo_apellido_estudiante, ' ', 
                            RFE.primer_nombre_estudiante, ' ', 
                            RFE.segundo_nombre_estudiante) AS NOMBRE_COMPLETO, 
                            RFCA.NUMERO_REGISTRO_ASIGNADO,
                            RFCA.ID_USUARIO,
                            RFCA.ID_CARRERA,
                            AC.NOMBRE_CARRERA FROM REG_FICHA_ESTUDIANTE RFE
                        JOIN REG_FICHA_CARRERA_ADMITIDO RFCA ON RFE.NUMERO_REGISTRO_ASIGNADO=RFCA.NUMERO_REGISTRO_ASIGNADO
                        JOIN ACA_CARRERA AC ON RFCA.ID_CARRERA=AC.ID_CARRERA),
                    listado_faltas as 
                        (SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
                                LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                                LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                                LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA)
                        
                SELECT tsfe.id_solicitud_falta_estudiante, tsfe.id_sancion_falta,
                        lf.nombre_tipo,
                        tsfe.numero_registro_asignado, e.nombre_completo,
                        to_char( tsfe.fecha_falta_cometida, 'yyyy-MM-dd') as fecha_falta_cometida,
                        tsfe.observaciones
                        
                    FROM tbl_solicitud_falta_estudiante tsfe
                    LEFT JOIN tbl_solicitud_apelacion tsa ON tsfe.id_solicitud_falta_estudiante=tsa.id_solicitud_falta_estudiante
                    JOIN estudiantes e ON tsfe.numero_registro_asignado=e.numero_registro_asignado
                    JOIN listado_faltas lf ON tsfe.id_sancion_falta=lf.id_sancion_falta
                    WHERE tsfe.borrado=false AND tsfe.sancionada=false
                    ORDER BY tsfe.fecha_falta_cometida asc");
        // dd($listarSancionados);
        
        return view('estadisticas.detalle', ['listarSancionados'=>$listarSancionados,
                                            'contarSanciones'=>$countSanciones,
                                            'fechaInicio'=>$fechaInicio,
                                            'fechaFinal'=>$fechaFinal,
                                            'listarEnEspera'=>$listarEnEspera]);
    }

    public function agruparFechaSanciones(Request $request)
    {

        //Capturar datos
        $fechaInicio=$request->fecha_inicio;
        $fechaFinal=$request->fecha_final;

        $data=DB::SELECT("WITH ESTUDIANTES AS 
                    (SELECT concat(RFE.primer_apellido_estudiante, ' ', 
                        RFE.segundo_apellido_estudiante, ' ', 
                        RFE.primer_nombre_estudiante, ' ', 
                        RFE.segundo_nombre_estudiante) AS NOMBRE_COMPLETO, 
                        RFCA.NUMERO_REGISTRO_ASIGNADO,
                        RFCA.ID_USUARIO,
                        RFCA.ID_CARRERA,
                        AC.NOMBRE_CARRERA FROM REG_FICHA_ESTUDIANTE RFE
                    JOIN REG_FICHA_CARRERA_ADMITIDO RFCA ON RFE.NUMERO_REGISTRO_ASIGNADO=RFCA.NUMERO_REGISTRO_ASIGNADO
                    JOIN ACA_CARRERA AC ON RFCA.ID_CARRERA=AC.ID_CARRERA),
            listado_faltas as 
                    (SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
                        LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                        LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                        LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA)
                    
            SELECT to_char( tse.fecha_sancion, 'yyyy-MM-dd') as fecha_sancion, count (tse.numero_registro_asignado) as cantidad_sanciones
                FROM tbl_sancion_estudiante tse
                JOIN estudiantes e ON tse.numero_registro_asignado=e.numero_registro_asignado
                WHERE tse.sancionado=true AND tse.fecha_sancion BETWEEN :fechaInicio AND :fechaFinal
                GROUP BY tse.fecha_sancion
                ORDER BY tse.fecha_sancion asc", ['fechaInicio'=>$fechaInicio, 'fechaFinal'=>$fechaFinal]);

        //dd($data);
        
        return response()->json($data, 200);
    }
}
