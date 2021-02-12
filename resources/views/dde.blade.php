@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modulo de Sanciones') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="text-center">
                            {{ __('Bienvenido') }}  {{ Auth::user()->name }}
                        </div>
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset('img/img1.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">Faltar</h5>
                                      <p class="card-text">El usuario podrá faltar al estudiante, si y solo si, el estudiante infrige una falta del reglamento universitario.</p>
                                      <a class="btn btn-primary mt-2 w-100 align-self-center text-light" href="{!! url("/buscar") !!}">Faltar</a>
                                    </div>
                                  </div>
                                  <div class="card mt-2">
                                    <img class="card-img-top" src="{{asset('img/img2.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">Sancionar</h5>
                                      <p class="card-text">El usuario podrá sancionar o no, a los estudiantes, considerando el proceso de sanción descrito en el reglamento universitario.</p>
                                      <a class="btn btn-cancelar mt-2 w-100 align-self-center text-light" href="{!! url("/sanciones") !!}">Sanciones
                                        <span class="text-right badge badge-pill badge-light ml-1">{{$contador}}</span></a>
                                    </div>
                                  </div>
                                
                                
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset('img/img3.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Historial</h5>
                                        <p class="card-text">Se visualiza el historial de faltas sancionadas de cada uno de los estudiantes.</p>
                                        <a class="btn btn-primary mt-2 w-100 align-self-center text-light" href="{!! url("/historial-faltas/buscar") !!}">Historial</a> 
                                    </div>
                                </div>      
                                <div class="card mt-2">
                                    <img class="card-img-top" src="{{asset('img/img4.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Reporte Estadístico</h5>
                                        <p class="card-text">Se visualiza el número de faltas sancionadas que se han realizado dentro de en un rango de tiempo específico.</p>
                                        <a class="btn btn-cancelar mt-2 w-100 align-self-center text-light" href="{!! url("/estadisticas") !!}">Estadísticas</a>  
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection