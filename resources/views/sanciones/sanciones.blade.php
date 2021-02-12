@extends('layouts.app')
@section('content')
<div class="container">
    @if ($quitar= Session::get('quitar'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Excelente!</strong> {{ $quitar }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if ($flash= Session::get('agregar'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Excelente!</strong> {{ $flash }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Sanciones') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif          
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="tablaSancionar" class="table table-striped" cellspacing="0" width="100%">
                                        <thead >
                                            <tr>
                                                <th class="scope">Fecha</th>
                                                <th class="scope">Nº Registro</th>
                                                <th class="scope">Nombre</th>
                                                <th class="scope">Tipo de Falta</th>
                                                <th class="scope">Observaciones</th>
                                                <th class="scope">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listarEstudianteFaltas as $row)
                                                <tr>
                                                    <td class="scope">{{$row->fecha_falta_cometida}}</td>
                                                    <td class="scope">{{$row->numero_registro_asignado}}</td>
                                                    <td class="scope">{{$row->nombre_completo}}</td>
                                                    <td class="scope">{{$row->nombre_tipo}}</td>
                                                    <td class="scope">{{$row->observaciones}}</td>
                                                    @if (Auth::user()->tipo==5)
                                                        @if ($row->nombre_tipo=='GRAVES' || $row->nombre_tipo=='MUY GRAVES')
                                                            <td class="scope">  <a class="btn btn-danger w-100 align-self-center text-light" href="">
                                                                <i class="icon ion-md-eye-off"></a></td>
                                                        @else
                                                            <td class="scope">  <a class="btn btn-cancelar w-100 align-self-center text-light" href="{!! url('sanciones/create/'.$row->numero_registro_asignado.'/'.$row->id_solicitud_falta_estudiante) !!}">
                                                                <i class="icon ion-md-eye"></a></td>
                                                        @endif
                                                       
                                                    @else
                                                        <td class="scope">  <a class="btn btn-cancelar w-100 align-self-center text-light" href="{!! url('sanciones/create/'.$row->numero_registro_asignado.'/'.$row->id_solicitud_falta_estudiante) !!}">
                                                            <i class="icon ion-md-eye"></a></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-cancelar  w-25 align-self-center text-light" href="{!! url('dde/') !!}">
                            <i class="icon ion-md-arrow-round-back"></i></a> 
                    </div> 
                               
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('script')

<script>
         $(document).ready(function() {
            $('#tablaSancionar').DataTable({
                columnDefs: [ { goals: [4]  }],
                responsive: true,
                "paging":   true,
                "info": true,
                autoWidth:  true,
                scrollY:     400,
                "scrollX": true,
                deferRender: true,
                scroller: {
                    loadingIndicator: true
                },  
               
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "Nada encontrado",
                    "info": "_PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrando de _MAX_ registros totales)",
                    "search":"Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                 
          
            });
            
            
        });
</script>
    
@endsection