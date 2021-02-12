@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Sancionar') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="card border-0">
                                    <div class="card-header">{{ __('Estudiante') }}</div>
                                    <div class="card-body">
                                        <div class="author text-center"> 
                                            <img src="{{ asset('/img/usuario.png') }}" alt="image" class="img-fluid rounded-circle avatar mr-2 align-items-center text-center" width="200" height="200">
                                            <h5 class="title text-center mt-3">{{$numero_registro_asignado}}</h5>
                                            <h4 class="title text-center mt-3">{{$nombre_completo}}</h4>
                                            <h5 class="title text-center mt-3">{{$nombre_carrera}}</h5>
                                            <h5 class="title text-center mt-3">{{$ubicacion}}</h5>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="card border-0">
                                    <div class="card-header">{{ __('Falta') }}</div>
                                    <div class="card-body">
                                        <div class="author"> 
                                            <h5 class="title text-left mt-3"><strong>Fecha: </strong></h5>
                                            <h6 class="title text-left mt-2">{{$fecha_falta_cometida}}</h6>
                                            <h5 class="title text-left mt-3"><strong>Responsable: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{$responsable}}</h6>
                                            <h5 class="title text-left mt-3"><strong>Falta: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{$falta_cometida}}</h6>
                                            <h5 class="title text-left mt-3"><strong>Tipo: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{$tipo_falta}}</h6>
                                            <h5 class="title text-left mt-3"><strong>Observaciones: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{$observacion}}</h6>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="card border-0">
                                    <div class="card-header">{{ __('Apelación') }}</div>
                                    <div class="card-body">
                                        <div class="author"> 
                                            <h5 class="title text-left mt-3"><strong>Fecha: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{$fecha_apelacion ?? '----/--/--'}}</h6>
                                            <h5 class="title text-left mt-3"><strong>Justificación: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{$justificacion ?? 'No presentó apelación'}}</h6>
                                            
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="card border-0">
                                    <div class="card-header">{{ __('Sanción') }}</div>
                                    <div class="card-body">
                                        <div class="author"> 
                                            <form action="/sanciones/create/{numero_registro_asignado}/{id_solicitud_falta_estudiante}" method="POST">
                                                {{-- Token --}}
                                                @csrf

                                                <div class="form-group">
                                                  <label for="InpuFecha">Fecha Sanción</label>
                                                  <input type="date" class="form-control" id="inputFechaSancion" name="inputFechaSancion" placeholder="" required>
                                                  
                                                </div>
                                                <div class="form-group">
                                                  <label for="inputSancion">Sanción que Amerita</label>
                                                  <div class="alert alert-dark" role="alert">
                                                    <h6>{{$nombre_sancion}}</h6>
                                                  </div>
                                                  
                                                </div>
                                                 
                                                <label for="exampleRadios">Sancionado</label><br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="true" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                     Si
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="false">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                      No
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Dictamen</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="inputDictamen" rows="3" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="InputIdUsuario" name="inputIdUsuario" value=" {{ Auth::user()->id }}">
                                                    <input type="hidden" class="form-control"  id="InputBorrado" name="inputBorrado" value="false">
                                                    <input type="hidden" class="form-control" id="InputNumeroRegistroAsignado" name="inputNumeroRegistroAsignado" value="{{$numero_registro_asignado}}">
                                                    <input type="hidden" class="form-control" id="InputFalta" name="inputFalta" value="{{$id_solicitud_falta_estudiante}}">
                                                    <input type="hidden" class="form-control" id="InputApelacacion" name="inputApelacion" value="{{$id_apelacion}}">
                                                </div>
                                                <div class="form-group text-right">
                                                    
                                                    <button type="submit" class="btn btn-primary ">Enviar</button> 
                                                </div>
                                              </form>
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
</div>
    
@endsection