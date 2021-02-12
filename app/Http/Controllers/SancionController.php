<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class SancionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solopersonal');
    }
    //Index
    public function index()
    {
        $tipo_usuario= Auth::user()->tipo;

        switch($tipo_usuario)
        {
            case('1'):
                $listarEstudianteFaltas=DB::SELECT("WITH ESTUDIANTES AS 
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
              WHERE tsfe.borrado=false AND tsfe.sancionada=false AND lf.nombre_tipo='MUY GRAVES' ");
            
            break;
            case('2'):
                $listarEstudianteFaltas=DB::SELECT("WITH ESTUDIANTES AS 
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
              WHERE tsfe.borrado=false AND tsfe.sancionada=false AND lf.nombre_tipo='GRAVES' ");
            
            break;

            case('5'):
                $listarEstudianteFaltas=DB::SELECT("WITH ESTUDIANTES AS 
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
                WHERE tsfe.borrado=false AND tsfe.sancionada=false");
            break;    
        }
        // dd($listarEstudianteFaltas);
        return view('sanciones.sanciones',["listarEstudianteFaltas"=>$listarEstudianteFaltas]);
    }

    public function create(Request $request)
    {
        $numero_registro_asignado=$request->numero_registro_asignado;
        $id_falta=$request->id_solicitud_falta_estudiante;
        

        $detalleEstudianteFalta=DB::SELECT("WITH ESTUDIANTES AS 
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
                  JOIN ACA_CARRERA AC ON RFCA.ID_CARRERA=AC.ID_CARRERA),
	            listado_faltas as 
					(SELECT TSF.ID_SANCION_FALTA, TF.DESCRIPCION, TTF.NOMBRE_TIPO, TS.NOMBRE_SANCION FROM TBL_SANCION_FALTA TSF
                            LEFT JOIN TBL_FALTAS TF ON TSF.ID_FALTA = TF.ID_FALTA
                            LEFT JOIN TBL_SANCIONES TS ON TSF.ID_SANCION = TS.ID_SANCION
                            LEFT JOIN TBL_TIPO_FALTA TTF ON TF.ID_TIPO_FALTA=TTF.ID_TIPO_FALTA)
				  
            SELECT tsfe.id_solicitud_falta_estudiante, tsfe.id_sancion_falta,
                    lf.nombre_tipo, lf.nombre_sancion,
                    lf.descripcion, 
		            tsfe.numero_registro_asignado, e.nombre_completo, e.nombre_carrera, 
                    CASE 
                        WHEN ubicacion = 'I' THEN 'Interno'
                        WHEN ubicacion = 'E' THEN 'Externo'
                        END ubicacion,
                    to_char( tsfe.fecha_falta_cometida, 'yyyy-MM-dd') as fecha_falta_cometida,
		            tsfe.observaciones, tsfe.responsable,
		            tsfe.borrado, tsfe.apelada,
		            tsa.id_apelacion,  to_char( tsa.fecha_apelacion, 'yyyy-MM-dd') as fecha_apelacion, 
		            tsa.justificacion, tsa.resolucion, 
		            tsa.borrado
	            FROM tbl_solicitud_falta_estudiante tsfe
	            LEFT JOIN tbl_solicitud_apelacion tsa ON tsfe.id_solicitud_falta_estudiante=tsa.id_solicitud_falta_estudiante
	            JOIN estudiantes e ON tsfe.numero_registro_asignado=e.numero_registro_asignado
                JOIN listado_faltas lf ON tsfe.id_sancion_falta=lf.id_sancion_falta
                WHERE tsfe.numero_registro_asignado=:numero_registro_asignado AND tsfe.id_solicitud_falta_estudiante=:id_falta AND tsfe.borrado=false AND tsfe.sancionada=false",["numero_registro_asignado"=>$numero_registro_asignado, "id_falta"=>$id_falta]);
        
        // dd($detalleEstudianteFalta);

        return view('sanciones.formSancion',[
                                        //Estudiante
                                        "numero_registro_asignado"=>$detalleEstudianteFalta[0]->numero_registro_asignado,
                                        "nombre_completo"=>$detalleEstudianteFalta[0]->nombre_completo,
                                        "nombre_carrera"=>$detalleEstudianteFalta[0]->nombre_carrera,
                                        "ubicacion"=>$detalleEstudianteFalta[0]->ubicacion,
                                        //Faltas
                                        "fecha_falta_cometida"=>$detalleEstudianteFalta[0]->fecha_falta_cometida,
                                        "responsable"=>$detalleEstudianteFalta[0]->responsable,
                                        "falta_cometida"=>$detalleEstudianteFalta[0]->descripcion,
                                        "observacion"=>$detalleEstudianteFalta[0]->observaciones,
                                        "tipo_falta"=>$detalleEstudianteFalta[0]->nombre_tipo,
                                        "id_solicitud_falta_estudiante"=>$detalleEstudianteFalta[0]->id_solicitud_falta_estudiante,
                                        //Apelacion
                                        "id_apelacion"=>$detalleEstudianteFalta[0]->id_apelacion,
                                        "fecha_apelacion"=>$detalleEstudianteFalta[0]->fecha_apelacion,
                                        "justificacion"=>$detalleEstudianteFalta[0]->justificacion,
                                        //Sancion
                                        "nombre_sancion"=>$detalleEstudianteFalta[0]->nombre_sancion
        ]);
    }

    public function store(Request $request)
    {
        //Validacion de datos
        request()->validate([
            'inputFechaSancion'=>'required',
            'inputDictamen'=>'required'
        ]);
        
        //Capturar datos
        $id_falta=$request->inputFalta;
        $id_apelacion=$request->inputApelacion;
        $numero_registro_asignado=$request->inputNumeroRegistroAsignado;
        $id_usuario=$request->inputIdUsuario;
        $borrado=$request->inputBorrado;
        $dictamen=$request->inputDictamen;
        $sancionado=$request->exampleRadios;
        $fecha_sancion=$request->inputFechaSancion;




        $insert=DB::INSERT("INSERT INTO tbl_sancion_estudiante(
                            id_solicitud_falta_estudiante, id_apelacion, numero_registro_asignado, id_usuario, borrado, dictamen, sancionado, fecha_sancion)
                            VALUES ( :id_falta, :id_apelacion, :numero_registro_asignado, :id_usuario, :borrado, :dictamen, :sancionado, :fecha_sancion)",
                            ["id_falta"=>$id_falta, 
                            "id_apelacion"=>$id_apelacion, 
                            "numero_registro_asignado"=>$numero_registro_asignado,
                            "id_usuario"=>$id_usuario, 
                            "borrado"=>$borrado,
                            "dictamen"=>$dictamen,
                            "sancionado"=>$sancionado, 
                            "fecha_sancion"=>$fecha_sancion]);
         
        if($sancionado=='true')
        {
            $update=DB::UPDATE("UPDATE tbl_solicitud_falta_estudiante
            SET  sancionada=true
            WHERE id_solicitud_falta_estudiante=:id_falta",["id_falta"=>$id_falta]);

            session()->flash('agregar', 'El Estudiante ha sido sancionado correctamente.');
        }
        elseif($sancionado=='false')
        {
            $update_borrado=DB::UPDATE("UPDATE tbl_solicitud_falta_estudiante
                                SET  borrado=true, sancionada=true
                                WHERE id_solicitud_falta_estudiante=:id_falta",["id_falta"=>$id_falta]);
            
            session()->flash('quitar', 'Al estudiante se le ha removido la falta.');
     
        }                    
        

        //return $request->all();
        return redirect()->route('sanciones.index');
    }
}
