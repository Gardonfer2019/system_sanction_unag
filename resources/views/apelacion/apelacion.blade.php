@extends('layouts.app')
@section('content')
<div class="container">
 
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Apelaciones') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tabla" class="table table-striped" cellspacing="10" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Falta</th>
                                            <th>Observaciones</th>
                                            <th>Acción</th>
                                        </tr>                                   
                                    </thead>
                                    <tbody>
                                        @foreach ($listarFaltasImpuestas as $row)
                                            <tr>
                                                <td type="date" class="scope">{!! $row->fecha_falta_cometida!!}</td>
                                                <td class="scope">{{$row->descripcion}}</td>
                                                <td class="scope">{{$row->observaciones}}</td>
                                                <td class="scope"><a class="btn btn-primary  w-100 align-self-center text-light" href="/apelacion/create/{{$row->id_solicitud_falta_estudiante}}">Apelar</a></td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            

                        </div>
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
        $('#tabla').DataTable({
            columnDefs: [ { goals: [4]  }],
            responsive: true,
            autoWidth:  false,
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