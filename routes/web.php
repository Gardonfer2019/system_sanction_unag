<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Rutas deacuerdo al tipo de usuario
Route::get('/home', 'HomeController@index')->name('home');//Docentes
Route::get('/estudiante', 'EstudianteController@index')->name('estudiante');
Route::get('/csu', 'CsuController@index')->name('csu');
Route::get('/cdf', 'CdfController@index')->name('cdf');
Route::get('/dde', 'DdeController@index')->name('dde');

// Modulo Buscar Estudiante
Route::get('/buscar', 'BuscadorController@index')->name('buscar.index');//Funcional

// Modulo Registrar Faltas
Route::get('/detalle/{numero_registro_asignado}', 'BuscadorController@buscarEstudiante');//Funcional
Route::post('/detalle/{numero_registro_asignado}', 'FaltasController@store')->name('falta.store');//Funcional

// Modulo Apelación
Route::get('/apelacion','ApelacionController@index')->name('apelacion.index');//Funcional
Route::get('/apelacion/create/{id_falta}','ApelacionController@create')->name('apelacion.create');//Funcional
Route::post('/apelacion/create/{id_falta}','ApelacionController@store')->name('apelacion.store');//Funcional

// Modulo Sancionar
Route::get('/sanciones', 'SancionController@index')->name('sanciones.index');//Funcional
Route::get('/sanciones/create/{numero_registro_asignado}/{id_solicitud_falta_estudiante}', 'SancionController@create')->name('sanciones.create');//Funcional
Route::post('/sanciones/create/{numero_registro_asignado}/{id_solicitud_falta_estudiante}', 'SancionController@store')->name('sanciones.store');//Funcional


// Modulo Historial o ficha disciplinaria
Route::get('/historial-faltas/buscar', 'HistorialFaltasController@index')->name('historial-faltas.index');//Funcional
Route::get('/historial-faltas/buscar/{numero_registro_asignado}', 'HistorialFaltasController@show')->name('historial-faltas.show');//Funcional
Route::post('/historial-faltas/buscar/{numero_registro_asignado}', 'HistorialFaltasController@edit')->name('historial-faltas.edit');//Funcional

//Grafico
Route::get('/grafica/{numero_registro_asignado}','HistorialFaltasController@datosGrafico');//Funcional

//Reportes
Route::get('/reporte/ficha-disciplinaria/{numero_registro_asignado}', 'ReportesController@fichaDisciplinaria')->name('reporte.fichaDisciplinaria');//Funcional

// Modulo Estadisticas
Route::get('/estadisticas','EstadisticasController@index')->name('estadisticas.index');//Funcional
Route::get('/estadisticas/rango/{fecha_inicio}/{fecha_final}', 'EstadisticasController@show');//Funcional
Route::get('/estadisticas/grafico/{fecha_inicio}/{fecha_final}', 'EstadisticasController@agruparFechaSanciones');//Funcional


//Errores
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//Pruebas
Route::get('/lista-faltas', 'BuscadorController@listarFaltas')->name('listarFaltas');
Route::get('/solicitud-falta/create', 'FaltasController@creat')->name('solicitud-falta.index');

Route::get('/datos',  'FaltasController@datosEstudiante');
Route::get('/datos/{numero_registro_asignado}',  'FaltasController@datosEstudiante')->name('datosEstudiante');