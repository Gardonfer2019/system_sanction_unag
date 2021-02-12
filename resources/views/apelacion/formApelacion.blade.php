@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Solicitud Apelación') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/apelacion/create/{id_falta}" method="post">
                                    {{-- TOKEN --}}
                                    @csrf
   
                                   {{-- Datos del Estudiante --}}
                                                       
                                    <div class="form-group">
                                       <label for="InputNumeroRegistroAsignado">Número de Registro</label>
                                       <input type="text" class="form-control" id="InputNumeroRegistroAsignado" name="inputNumeroRegistroAsignado" placeholder="" value="{{$numero_registro_asignado}}" readonly>    
                                    </div>

                                    <div class="form-group">
                                        <label for="InputNombreCompeto">Nombre Completo</label>
                                        <input type="text" class="form-control" id="InputNombreCompeto" name="inputNombreCompeto" placeholder="" value="{{Auth::user()->name}}" readonly>    
                                    </div>
                                    
                                   {{-- Falta --}}

                                    <div class="form-group">
                                        <label for="FormControlFalta">Falta Cometida</label>
                                        <div class="alert alert-dark" role="alert">
                                            {{$descripcion}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="FormControlObservaciones">Observaciones</label>
                                        <div class="alert alert-dark" role="alert">
                                            {{$observaciones}}
                                        </div>
                                        
                                    </div>
                                   
                                    {{-- Fecha --}}
   
                                   <div class="form-group">
                                       <label for="InputFechaApelacion">Fecha Apelación</label>
                                       <input type="date" class="form-control" id="InputFechaApelacion" name="inputFechaApelacion" placeholder="2021-01-07"  required>
                                   </div>

                                   {{-- Justificación --}}

                                   <div class="form-group">
                                        <label for="FormControlJustificacion">Justificación</label>
                                        <textarea class="form-control" id="FormControlJustificacion" name="inputJustificacion" rows="3" required></textarea>
                                   </div>

                                   {{-- Otros --}}
                                   <div class="form-group">
                                        <input type="hidden" class="form-control" id="InputBorrado" name="inputBorrado" value="false">
                                        <input type="hidden" class="form-control" id="InputResolucion" name="inputResolucion" value="true">
                                        <input type="hidden" class="form-control" id="InputApelada" name="inputApelada" value="true">
                                        <input type="hidden" class="form-control" id="InputIdFalta" name="inputIdFalta" value="{{$id_falta}}">
                                   </div>

                                   {{-- Button --}}

                                    <div class="form-group text-right">
                                        <a class="btn btn-cancelar w-10 align-self-center text-light" href="{!! url("/apelacion") !!}">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
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
    
@endsection