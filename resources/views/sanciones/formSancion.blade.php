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
                                <div class="col-lg-12 ">
                                    <p>

                                        <button class="btn btn-danger" type="button" data-toggle="collapse"
                                            data-target="#collapseExample" aria-expanded="true"
                                            aria-controls="collapseExample">
                                            Reincide
                                        </button>
                                    </p>
                                    <div class="collapse show" id="collapseExample">
                                        <div class="card card-body">
                                            @if ($ComprobarReincidencia == 'false')
                                                No Tiene reincidencia
                                            @else
                                                <h3> <span class="badge bg-danger text-light">Esta Reincidiendo</span></h3>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-condensed">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th  scope="col">#</th>
                                                                <th  scope="col">Observaciones</th>
                                                                <th  scope="col">fecha</th>
                                                                <th  scope="col">Reporto</th>
                                                                <th scope="col">Reincidencia</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                @foreach ($listarReincidencia as $row)
                                                            <tr>
                                                                <th scope="row">{{ $row->id_solicitud_falta_estudiante }}</th>
                                                                <th scope="">{{ $row->observaciones }}</th>
                                                                <th scope="">{{ $row->fecha_falta_cometida }}</th>
                                                                <th scope="">{{ $row->responsable }}</th>
                                                                <th scope="">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-toggle="modal" data-target="#exampleModal"><i class="icon ion-md-share-alt"></i>
                                                                        
                                                                    </button>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">Reincidencia
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="container">
                                                                                        {{-- Formulario --}}
                                                                                        <form action="{{url("/disciplinario/reincidencia")}}" method="POST">
                                                                                            @csrf
                                                                                            <div class="form-group">
                                                                                                <label for="exampleFormControlSelect1">Seleccionar Reincidencia</label>
                                                                                                <select class="form-control" id="exampleFormControlSelect1" name="seleccionReincidencia">
                                                                                                @foreach ($listarFaltaReincidencia as $i)
                                                                                                
                                                                                                    <option value="{{$i->id_sancion_falta}}">{{$i->descripcion}}</option>

                                                                                                @endforeach
                                                                                            </select>
                                                                                             
                                                                                            <div class="form-group">
                                                                                                {{-- Datos Solicitud Falta --}}
                                                                                                <input type="hidden" class="form-control" id="InputIdUsuario"
                                                                                                name="inputIdUsuario" value=" {{ Auth::user()->id }}">
                                                                                                <input type="hidden" class="form-control" id="InputNumeroRegistroAsignado" name="inputNumeroRegistroAsignado"
                                                                                                value="{{ $numero_registro_asignado }}">
                                                                                                
                                                                                                <input type="hidden" class="form-control" id="InputAño"
                                                                                                name="InputAño" value="{{$año}}">
                                                                                                <input type="hidden" class="form-control" id="InputPeriodo"
                                                                                                name="InputPeriodo" value="{{$periodo}}">
                                                                                                <input type="hidden" class="form-control" id="InputObservaciones"
                                                                                                name="InputObservaciones" value="{{'Reincidencia en la falta: '.$falta_cometida.' y es de tipo de faltas '.$tipo_falta}}">
                                                                                                <input type="hidden" class="form-control" id="InputResponsable"
                                                                                                name="InputResponsable" value="{{'DDE'}}">

                                                                                                <input type="hidden" class="form-control" id="InputBorrado"
                                                                                                name="inputBorrado" value="false">
                                                                                                <input type="hidden" class="form-control" id="InputApelada"
                                                                                                name="InputApelada" value="false">
                                                                                                <input type="hidden" class="form-control" id="InputSancionada"
                                                                                                name="InputSancionada" value="true">
                                                                                                <input type="hidden" class="form-control" id="InputReincidencia"
                                                                                                name="InputReincidencia" value="true">
                                                                                               {{-- Datos Sancion  --}}
                                                                                               <input type="hidden" class="form-control" id="InputFalta"
                                                                                                name="inputFalta" value="{{ $id_solicitud_falta_estudiante }}">
                                                                                                <input type="hidden" class="form-control" id="InputFalta2"
                                                                                                name="inputFalta2" value="{{ $row->id_solicitud_falta_estudiante }}">
                                                                                                <input type="hidden" class="form-control" id="InputObservacion"
                                                                                                name="InputObservacion" value="{{'Reincidencia  por falta de tipo  '.$tipo_falta}}">

                                                                                            </div>
                                                                                            <div class="text-right">
                                                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                                                            </div>
                                                                                            
                                                                                          </form>
                                                                                    </div>
                                                                                </div>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>

                                            @endforeach
                                            </tr>
                                            </tbody>

                                            </table>
                                        </div>


                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="card border-0">
                                    <div class="card-header">{{ __('Estudiante') }}</div>
                                    <div class="card-body">
                                        <div class="author text-center">
                                            <img src="{{ asset('/img/usuario.png') }}" alt="image"
                                                class="img-fluid rounded-circle avatar mr-2 align-items-center text-center"
                                                width="200" height="200">
                                            <h5 class="title text-center mt-3">{{ $numero_registro_asignado }}</h5>
                                            <h4 class="title text-center mt-3">{{ $nombre_completo }}</h4>
                                            <h5 class="title text-center mt-3">{{ $nombre_carrera }}</h5>
                                            <h5 class="title text-center mt-3">{{ $ubicacion }}</h5>
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
                                            <h6 class="title text-left mt-2">{{ $fecha_falta_cometida }}</h6>
                                            <h5 class="title text-left mt-3"><strong>Responsable: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{ $responsable }}</h6>
                                            <h5 class="title text-left mt-3"><strong>Falta: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{ $id_sancion_falta }}.
                                                {{ $falta_cometida }}</h6>
                                            <h5 class="title text-left mt-3"><strong>Tipo: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{ $tipo_falta }}</h6>
                                            <h5 class="title text-left mt-3"><strong>Observaciones: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">{{ $observacion }}</h6>
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
                                            <h6 class="title text-left mt-2">{{ $fecha_apelacion ?? '----/--/--' }}</h6>
                                            <h5 class="title text-left mt-3"><strong>Justificación: </strong> <br> </h5>
                                            <h6 class="title text-left mt-2">
                                                {{ $justificacion ?? 'No presentó apelación' }}</h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="card border-0">
                                    <div class="card-header">{{ __('Sanción') }}</div>
                                    <div class="card-body">
                                        <div class="author">
                                            <form
                                                action="/sanciones/create/{numero_registro_asignado}/{id_solicitud_falta_estudiante}"
                                                method="POST">
                                                {{-- Token --}}
                                                @csrf

                                                <div class="form-group">
                                                    <label for="InpuFecha">Fecha Sanción</label>
                                                    <input type="date" class="form-control" id="inputFechaSancion"
                                                        name="inputFechaSancion" placeholder="" required>

                                                </div>
                                                <div class="form-group">
                                                    <label for="inputSancion">Sanción que Amerita</label>
                                                    <div class="alert alert-dark" role="alert">
                                                        <h6>{{ $nombre_sancion }}</h6>
                                                    </div>

                                                </div>

                                                <label for="exampleRadios">Sancionado</label><br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                                        id="exampleRadios1" value="true" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                                        id="exampleRadios2" value="false">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        No
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Dictamen</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                                        name="inputDictamen" rows="3" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="InputIdUsuario"
                                                        name="inputIdUsuario" value=" {{ Auth::user()->id }}">
                                                    <input type="hidden" class="form-control" id="InputBorrado"
                                                        name="inputBorrado" value="false">
                                                    <input type="hidden" class="form-control"
                                                        id="InputNumeroRegistroAsignado" name="inputNumeroRegistroAsignado"
                                                        value="{{ $numero_registro_asignado }}">
                                                    <input type="hidden" class="form-control" id="InputFalta"
                                                        name="inputFalta" value="{{ $id_solicitud_falta_estudiante }}">
                                                    <input type="hidden" class="form-control" id="InputApelacacion"
                                                        name="inputApelacion" value="{{ $id_apelacion }}">
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
