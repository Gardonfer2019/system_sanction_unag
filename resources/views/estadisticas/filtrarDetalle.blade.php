@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Filtar Fechas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="text-center">
                           <h5><strong>{{ __('Ingrese un Rango') }}</strong></h5> 
                        </div>
                        <Form action="{{url('/estadisticas/rango/{fecha_inicio}/{fecha_final}')}}" method="GET">
                            
                            <div class="row">
                                <div class="col-lg-6 my-2">
                                            {{-- Fecha Inicio--}}                             
                                    <div class="form-group">
                                        <label for="InputFechaInicio">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="InputFechaInicio" name="inputFechaInicio" placeholder="2021-01-07"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6 my-2">
                                            {{-- Fecha Final--}}
                                    <div class="form-group">
                                        <label for="InputFechaFinal">Fecha Final</label>
                                        <input type="date" class="form-control" id="InputFechaFinal" name="inputFechaFinal" placeholder="2021-01-07"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary ">Buscar</button>
                            </div>
                        </Form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection