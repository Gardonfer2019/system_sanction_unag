<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

class ReportesController extends Controller
{
    protected $RPT_FICHA_DISCIPLINARIA;

    protected $INPUT_RPT_PAHT;
    protected $OUTPUT_RPT_PATH;
    protected $dbConnection=array();


    public function __construct(){
        $this->RPT_FICHA_DISCIPLINARIA='ficha_disciplinaria';

        $this->INPUT_RPT_PAHT=app_path().'/Documents/Reports/';
        $this->OUTPUT_RPT_PATH='/documents/reports/';

        $this->dbConnection=[
            'driver'=> 'postgres',
            'username'=> env('DB_USERNAME'),
            'password'=> env('DB_PASSWORD'),
            'host'=> env('DB_HOST'),
            'database'=> env('DB_DATABASE'),
            'port'=> env('DB_PORT')
        ];

    }
    public function fichaDisciplinaria(Request $request, $numero_registro_asignado){
        $input = $this->INPUT_RPT_PAHT.$this->RPT_FICHA_DISCIPLINARIA.'.jrxml';
        $inputCompilado = $this->INPUT_RPT_PAHT.$this->RPT_FICHA_DISCIPLINARIA.'.jasper';

        $outhput = $this->OUTPUT_RPT_PATH.'/'.$this->RPT_FICHA_DISCIPLINARIA;

        if(!file_exists($inputCompilado)){
            $jasper=new PHPJasper;
            $jasper-> compile($input)->execute();
        }

        $options=[
            'format'=>['pdf'],
            'params'=>['numero_registro_asignado'=>$numero_registro_asignado],
            'db_connection'=> $this->dbConnection
        ];

        $jasper=new PHPJasper;
        // $outputCommand=
        //     $jasper->process(
        //         $inputCompilado,
        //         public_path().$outhput,
        //         $options
        //     )->output();

    
            $jasper->process(
                $inputCompilado,
                public_path().$outhput,
                $options
            )->execute();

        return view('reportes.generico')->with('reportName',$outhput.'.pdf');

    }
}
