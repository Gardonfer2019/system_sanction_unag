<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CsuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solocsu',['only'=>'index']);
    }

    public function index(){
        $registros=DB::SELECT("WITH ESTUDIANTES AS 
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
                WHERE tsfe.borrado=false AND tsfe.sancionada=false AND lf.nombre_tipo='MUY GRAVES'");
        
        $count= count($registros);
        return view('csu', ['contador'=>$count]);
    }
}
